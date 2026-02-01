<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class ShowReviews extends Component
{

    public $reviews;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->reviews = $this->getFacebookPageReviews();
    }


    /**
     * Get Facebook page reviews
     * 
     * Note: You'll need to:
     * 1. Create a Facebook App at https://developers.facebook.com
     * 2. Get a Page Access Token
     * 3. Store it in your .env file as FACEBOOK_PAGE_ACCESS_TOKEN
     * 4. Replace PAGE_ID with your actual page ID (awlaadelblad)
     * 
     * @return array
     */
    private function getFacebookPageReviews()
    {
        
            $pageId = 'awlaadelblad'; // Or use your numeric page ID
            $accessToken = env('FACEBOOK_PAGE_ACCESS_TOKEN');
            
            if (!$accessToken) {
                return $this->getDefaultReviews();
            }

            // Facebook Graph API endpoint for page reviews
            $url = "https://graph.facebook.com/v18.0/{$pageId}/reviews";

            
            $response = Http::get($url, [
                'access_token' => $accessToken,
                'fields' => 'reviewer{name,picture},rating,review_text,created_time'
                ]);
                
                dd($response);
            if ($response->successful()) {
                $data = $response->json();
                return $this->formatReviews($data['data'] ?? []);
            }

            return $this->getDefaultReviews();

       
            return $this->getDefaultReviews();
        
    }

    
    /**
     * Format reviews data
     * 
     * @param array $reviews
     * @return array
     */
    private function formatReviews($reviews)
    {
        return collect($reviews)->map(function ($review) {
            return [
                'name' => $review['reviewer']['name'] ?? 'Anonymous',
                'avatar' => $review['reviewer']['picture']['data']['url'] ?? null,
                'rating' => $review['rating'] ?? 5,
                'text' => $review['review_text'] ?? '',
                'date' => \Carbon\Carbon::parse($review['created_time'])->format('M d, Y'),
            ];
        })->toArray();
    }

    /**
     * Default reviews fallback (in case API fails)
     * 
     * @return array
     */
    private function getDefaultReviews()
    {
        return [
            [
                'name' => 'نيو نيوتن في الرياضيات',
                'avatar' => null,
                'rating' => 5,
                'text' => 'افضل شركه دعايا وتسويق واداره صفحات سوشيال ميديا تعاملت معاها بصراحه شركه...',
                'date' => 'August 20, 2023',
            ],
            [
                'name' => 'Youssef Askar',
                'avatar' => null,
                'rating' => 5,
                'text' => 'cool page for hiring people to make amazing services',
                'date' => 'August 20, 2023',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show-reviews');
    }
}
