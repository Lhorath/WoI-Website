<?php
declare(strict_types=1);

final class HomePage
{
    public function content(): array
    {
        return [
            'slides' => [
                [
                    'image' => 'simple_img_1.jpg',
                    'heading' => 'Welcome to the Realm',
                    'subheading' => 'Your journey through the World of Immortality begins here.',
                ],
                [
                    'image' => 'simple_img_2.jpg',
                    'heading' => 'Explore a World of Adventure',
                    'subheading' => 'Discover new places, meet allies, and make your mark.',
                ],
                [
                    'image' => 'simple_img_2_.jpg',
                    'heading' => 'Find Your Path',
                    'subheading' => 'Take on challenges and shape your own story.',
                ],
                [
                    'image' => 'simple_img_3.jpg',
                    'heading' => 'Join the Community',
                    'subheading' => 'Share your adventures with players from across the realm.',
                ],
                [
                    'image' => 'simple_img_4.jpg',
                    'heading' => 'Build Your Legacy',
                    'subheading' => 'Every great journey starts with a single step.',
                ],
                [
                    'image' => 'simple_img_5.jpg',
                    'heading' => 'Become Part of the Story',
                    'subheading' => 'Create your account and begin your adventure today.',
                ],
            ],
            'featureTitle' => 'Join us Today!',
            'featureText' => 'Update your realmlist file with "set realmlist woilogon.nerdygamertools.com" to connect to the server and start your adventure.'
        ];
    }
}
