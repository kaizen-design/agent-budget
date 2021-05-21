<?php
/**
 * Template Name: Report
 */

if ( !is_user_logged_in() ) {
  auth_redirect();
}

//  TODO: add redirect to the questionnaire if it's not completed

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

//  REPORT
$context['report'] = [
  'life_goals' => [
    'success_definition' => get_user_meta($context['user']['id'], 'success_definition', true),
    'spiritual_health' => get_user_meta($context['user']['id'], 'spiritual_health', true),
    'relational_health' => get_user_meta($context['user']['id'], 'relational_health', true),
    'physical_health' => get_user_meta($context['user']['id'], 'physical_health', true),
    'emotional_health' => get_user_meta($context['user']['id'], 'emotional_health', true),
    'mental_health' => get_user_meta($context['user']['id'], 'mental_health', true),
    'vocational_health' => get_user_meta($context['user']['id'], 'vocational_health', true),
    'financial_health' => get_user_meta($context['user']['id'], 'financial_health', true)
  ],
  'financial_goals' => [
    'months_12' => get_user_meta($context['user']['id'], 'financial_goal_12_months', true),
    'months_24' => get_user_meta($context['user']['id'], 'financial_goal_24_months', true),
    'months_60' => get_user_meta($context['user']['id'], 'financial_goal_60_months', true),
  ],
  'direct_sales' => [
    'my_farm_properties' => get_user_meta($context['user']['id'], 'my_farm_properties', true),
    'avg_price_per_sale' => get_user_meta($context['user']['id'], 'avg_price_per_sale', true),
    'open_houses' => get_user_meta($context['user']['id'], 'open_houses', true),
    'gross_commission_rate' => get_user_meta($context['user']['id'], 'gross_commission_rate', true),
  ],
  'potential_income' => [
    //  TODO: add calculations here
  ],
  'recruiting_overrides' => [
    //  TODO: add levels functionality
    'agents_recruit' => get_user_meta($context['user']['id'], 'revenue_share_agents_recruit', true),
    'transactions' => get_user_meta($context['user']['id'], 'revenue_share_transactions', true),
    'highest_sold_price' => get_user_meta($context['user']['id'], 'revenue_share_highest_sold_price', true),
    'lowest_sold_price' => get_user_meta($context['user']['id'], 'revenue_share_lowest_sold_price', true),
  ],
  'opportunities' => [
    'agent_concept' => [
      'introductions' => get_user_meta($context['user']['id'], 'agent_concept_introductions', true),
      'success_rate' => get_user_meta($context['user']['id'], 'agent_concept_success_rate', true),
      'transactions' => get_user_meta($context['user']['id'], 'agent_concept_transactions', true),
      'avg_cost' => get_user_meta($context['user']['id'], 'agent_concept_avg_cost', true),
    ],
    'agent_farm' => [
    
    ],
    //  TODO: add more opportunities (per spreadsheet)
  ]
];

function get_financial_goals_progress ($goal) {
  $values = ['$100k - $150k', '$150k - $250k', '$250k - $400k', '$400k - $600k', '$600k '];
  return array_search($goal, $values) ? (array_search($goal, $values) + 1) * 20 : false;
}

Timber::render( 'report/index.twig', $context );
