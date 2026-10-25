<?php

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('shows Other as a department option and includes its input field', function () {
    $response = $this->get(route('jobs.create'));

    $response->assertOk();
    $response->assertSee('<option value="Other"', false);
    $response->assertSee('id="other-department-wrapper"', false);
    $response->assertSee('name="other_department"', false);
});

it('stores the entered department name when Other is selected', function () {
    $response = $this->post(route('jobs.store'), [
        'title' => 'Data Platform Engineer',
        'department' => 'Other',
        'other_department' => 'Data Science',
        'description' => 'Build and maintain data platforms.',
        'skills' => 'Python, SQL',
        'weights' => [
            'coding_test' => 50,
            'interview' => 30,
            'cv_screening' => 20,
        ],
    ]);

    $response->assertRedirect(route('jobs.create'));
    $response->assertSessionHas('success');
    $this->assertDatabaseHas('list_items', [
        'title' => 'Data Platform Engineer',
        'department' => 'Data Science',
    ]);
});

it('requires a custom department name when Other is selected', function () {
    $response = $this->from(route('jobs.create'))->post(route('jobs.store'), [
        'title' => 'Data Platform Engineer',
        'department' => 'Other',
        'description' => 'Build and maintain data platforms.',
        'skills' => 'Python, SQL',
        'weights' => [
            'coding_test' => 50,
            'interview' => 30,
            'cv_screening' => 20,
        ],
    ]);

    $response->assertRedirect(route('jobs.create'));
    $response->assertSessionHasErrors('other_department');
    $this->assertDatabaseMissing('list_items', [
        'title' => 'Data Platform Engineer',
    ]);
});

it('stores a selected department without requiring a custom name', function () {
    $response = $this->post(route('jobs.store'), [
        'title' => 'Frontend Engineer',
        'department' => 'Engineering',
        'description' => 'Build user interfaces.',
        'skills' => 'JavaScript, CSS',
        'weights' => [
            'coding_test' => 50,
            'interview' => 30,
            'cv_screening' => 20,
        ],
    ]);

    $response->assertRedirect(route('jobs.create'));
    $this->assertDatabaseHas('list_items', [
        'title' => 'Frontend Engineer',
        'department' => 'Engineering',
    ]);
});
