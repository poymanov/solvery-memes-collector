<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Попытка посещения гостем
 */
test('guest', function () {
    $this->get(routeBuilderHelper()->parsingSource->vk->index())->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Попытка посещения гостем
 */
test('not admin', function () {
    authHelper()->signIn();
    $this->get(routeBuilderHelper()->parsingSource->vk->index())->assertForbidden();
});

/**
 * Успешное открытие страницы
 */
test('success', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $response = $this->get(routeBuilderHelper()->parsingSource->vk->index());
    $response->assertOk();

    $response->assertSeeText($vkParsingSource->title);
    $response->assertSeeText($vkParsingSource->url);
});
