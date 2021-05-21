<?php
/**
 * Template Name: Report
 */

if ( !is_user_logged_in() ) {
  auth_redirect();
}

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$user = wp_get_current_user();
$userID = $user->ID;

//  REPORT
$context['report'] = [
  'life_goals' => [
    'success_definition' => get_user_meta($userID, 'success_definition', true),
    'spiritual_health' => get_user_meta($userID, 'spiritual_health', true),
    'relational_health' => get_user_meta($userID, 'relational_health', true),
    'physical_health' => get_user_meta($userID, 'physical_health', true),
    'emotional_health' => get_user_meta($userID, 'emotional_health', true),
    'mental_health' => get_user_meta($userID, 'mental_health', true),
    'vocational_health' => get_user_meta($userID, 'vocational_health', true),
    'financial_health' => get_user_meta($userID, 'financial_health', true)
  ],
  'financial_goals' => [
    'months_12' => get_user_meta($userID, 'financial_goal_12_months', true),
    'months_24' => get_user_meta($userID, 'financial_goal_24_months', true),
    'months_60' => get_user_meta($userID, 'financial_goal_60_months', true),
  ]
];

function get_financial_goals_progress ($goal) {
  $values = ['$100k - $150k', '$150k - $250k', '$250k - $400k', '$400k - $600k', '$600k '];
  return array_search($goal, $values) ? (array_search($goal, $values) + 1) * 20 : false;
}

Timber::render( 'report/index.twig', $context );
