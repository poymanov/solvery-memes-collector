<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Попытка посещения гостем
 */
test('guest', function () {
    $this->get(routeBuilderHelper()->meme->index())->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Успешное отображение
 */
test('success', function () {
    authHelper()->signIn();

    $meme = modelBuilderHelper()->meme->create();

    $response = $this->get(routeBuilderHelper()->meme->index());
    $response->assertOk();

    $response->assertSee($meme->text);
});
