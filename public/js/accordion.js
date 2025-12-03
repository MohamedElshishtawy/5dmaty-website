document.addEventListener('DOMContentLoaded', function () {
    const accordion = document.getElementById('faqAccordion');
    if (!accordion) return;

    const buttons = accordion.querySelectorAll('.accordion-button');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const target = document.querySelector(targetId);
            const parentAccordion = this.closest('.accordion');

            // Check if this button is already active
            const isExpanded = !this.classList.contains('collapsed');

            // Close all other items in the same accordion
            const allCollapses = parentAccordion.querySelectorAll('.accordion-collapse');
            const allButtons = parentAccordion.querySelectorAll('.accordion-button');

            allCollapses.forEach(collapse => {
                if (collapse !== target) {
                    slideUp(collapse);
                    const relatedButton = parentAccordion.querySelector(`[data-target="#${collapse.id}"]`);
                    if (relatedButton) {
                        relatedButton.classList.add('collapsed');
                    }
                }
            });

            // Toggle current item
            if (isExpanded) {
                slideUp(target);
                this.classList.add('collapsed');
            } else {
                slideDown(target);
                this.classList.remove('collapsed');
            }
        });
    });

    function slideDown(element) {
        element.classList.remove('collapse');
        element.classList.add('collapsing');
        element.style.height = '0';

        const height = element.scrollHeight;

        setTimeout(() => {
            element.style.height = height + 'px';
        }, 10);

        setTimeout(() => {
            element.classList.remove('collapsing');
            element.classList.add('collapse', 'show');
            element.style.height = '';
        }, 350);
    }

    function slideUp(element) {
        element.style.height = element.scrollHeight + 'px';
        element.classList.add('collapsing');
        element.classList.remove('collapse', 'show');

        setTimeout(() => {
            element.style.height = '0';
        }, 10);

        setTimeout(() => {
            element.classList.remove('collapsing');
            element.classList.add('collapse');
            element.style.height = '';
        }, 350);
    }
});