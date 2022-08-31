<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Попытка посещения гостем
 */
test('guest', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    $this->get(routeBuilderHelper()->parsingSource->vk->edit($vkParsingSource->id))->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Попытка посещения гостем
 */
test('not admin', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signIn();
    $this->get(routeBuilderHelper()->parsingSource->vk->edit($vkParsingSource->id))->assertForbidden();
});

/**
 * Попытка посещения страницы редактирования несуществующего источника
 */
test('not exists', function () {
    authHelper()->signInAsAdmin();

    $this->get(routeBuilderHelper()->parsingSource->vk->edit(999))->assertNotFound();
});

/**
 * Успешное открытие страницы
 */
test('success', function () {
    $vkParsingSource = modelBuilderHelper()->parsingSource->vk->create();

    authHelper()->signInAsAdmin();

    $response = $this->get(routeBuilderHelper()->parsingSource->vk->edit($vkParsingSource->id));
    $response->assertOk();

    $response->assertSee($vkParsingSource->title);
    $response->assertSee($vkParsingSource->url);
});
