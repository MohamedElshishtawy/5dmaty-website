/**
 * Facebook Reviews - Image Validation Script
 * Checks if avatar images exist before rendering
 * Removes img element if image URL is invalid or fails to load
 */

(function() {
    'use strict';

    /**
     * Check if image URL is valid and accessible
     * @param {string} url - Image URL to check
     * @returns {Promise<boolean>}
     */
    function imageExists(url) {
        return new Promise((resolve) => {
            if (!url) {
                resolve(false);
                return;
            }

            const img = new Image();
            
            img.onload = function() {
                resolve(true);
            };
            
            img.onerror = function() {
                resolve(false);
            };
            
            // Timeout after 5 seconds
            const timeout = setTimeout(() => {
                resolve(false);
            }, 5000);
            
            img.onload = function() {
                clearTimeout(timeout);
                resolve(true);
            };
            
            img.onerror = function() {
                clearTimeout(timeout);
                resolve(false);
            };
            
            img.src = url;
        });
    }

    /**
     * Validate all review card images
     */
    async function validateReviewImages() {
        const avatars = document.querySelectorAll('.review-card .avatar');
        const fbIcon  = document.querySelector('.media-icon');
        
        for (let avatar of avatars) {
            const src = avatar.getAttribute('src');
            const exists = await imageExists(src);
            
            if (!exists) {
                // Remove the image element
                avatar.remove();
                fbIcon.remove();
                
                // Optional: Add a fallback initial instead
                const userInfo = avatar.parentElement.querySelector('.user-info');
                if (userInfo) {
                    const firstName = userInfo.querySelector('.user-name')?.textContent.split(' ')[0] || 'U';
                    const initial = document.createElement('div');
                    initial.className = 'avatar-initial';
                    initial.textContent = firstName.charAt(0).toUpperCase();
                    avatar.parentElement.insertBefore(initial, userInfo);
                }
            }
        }
    }

    /**
     * Alternative: Validate images on load with fallback
     */
    function validateReviewImagesWithFallback() {
        const avatars = document.querySelectorAll('.review-card .avatar');
        const fbIcon  = document.querySelector('.media-icon ');


        
        avatars.forEach(avatar => {
            const src = avatar.getAttribute('src');
            
            if (!src) {
                avatar.remove();
                fbIcon.remove();
                return;
            }
            
            avatar.onerror = function() {
                // Remove image on error
                this.remove();
                fbIcon.remove();
                
                // Add fallback initial
                const cardHeader = this.parentElement;
                const userInfo = cardHeader.querySelector('.user-info');
                
                if (userInfo && !cardHeader.querySelector('.avatar-initial')) {
                    const firstName = userInfo.querySelector('.user-name')?.textContent.split(' ')[0] || 'U';
                    const initial = document.createElement('div');
                    initial.className = 'avatar-initial';
                    initial.textContent = firstName.charAt(0).toUpperCase();
                    cardHeader.insertBefore(initial, userInfo);
                }
            };
            
            // Trigger check by setting src again
            avatar.src = src;
        });
    }

    /**
     * Initialize when DOM is ready
     */
    function init() {
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', validateReviewImagesWithFallback);
        } else {
            validateReviewImagesWithFallback();
        }
    }

    // Start initialization
    init();

    // Optional: Expose functions globally for manual use
    window.FacebookReviews = {
        checkImage: imageExists,
        validateImages: validateReviewImages,
        validateImagesWithFallback: validateReviewImagesWithFallback
    };

})();