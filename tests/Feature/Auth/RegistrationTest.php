<?php

test('public registration is disabled and redirects to login', function () {
    $response = $this->get('/register');

    $response->assertRedirect(route('login'));
});

test('submitting registration is rejected and redirects to login', function () {
    $response = $this->post('/register', [
        'name' => 'Public User',
        'email' => 'public@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('login'));
    $this->assertGuest();
});
