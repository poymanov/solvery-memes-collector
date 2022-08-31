<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * Попытка посещения гостем
 */
test('guest', function () {
    $this->get(routeBuilderHelper()->parsingSource->vk->create())->assertRedirect(routeBuilderHelper()->auth->login());
});

/**
 * Попытка посещения гостем
 */
test('not admin', function () {
    authHelper()->signIn();
    $this->get(routeBuilderHelper()->parsingSource->vk->create())->assertForbidden();
});

/**
 * Успешное открытие страницы
 */
test('success', function () {
    authHelper()->signInAsAdmin();
    $this->get(routeBuilderHelper()->parsingSource->vk->create())->assertOk();
});
