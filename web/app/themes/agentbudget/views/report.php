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

$userID = $context['user']['id'];

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
  ],
  'direct_sales' => [
    'my_farm_properties' => get_user_meta($userID, 'my_farm_properties', true),
    'avg_price_per_sale' => get_user_meta($userID, 'avg_price_per_sale', true),
    'open_houses' => get_user_meta($userID, 'open_houses', true),
    'gross_commission_rate' => get_user_meta($userID, 'gross_commission_rate', true),
  ],
  'potential_income' => [
    //  TODO: add calculations here
  ],
  'recruiting_overrides' => [
    //  TODO: add levels functionality
    'agents_recruit' => get_user_meta($userID, 'revenue_share_agents_recruit', true),
    'transactions' => get_user_meta($userID, 'revenue_share_transactions', true),
    'highest_sold_price' => get_user_meta($userID, 'revenue_share_highest_sold_price', true),
    'lowest_sold_price' => get_user_meta($userID, 'revenue_share_lowest_sold_price', true),
  ],
  'opportunities' => [
    'agent_concept' => [
      'introductions' => get_user_meta($userID, 'agent_concept_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_concept_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_concept_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_concept_avg_cost', true),
    ],
    'agent_farm' => [
    
    ],
    //  TODO: add more opportunities (per spreadsheet)
  ],
  'expenses' => [
    'eo_insurance' => get_user_meta($userID, 'eo_insurance', true),
    'realtor_dues' => get_user_meta($userID, 'realtor_dues', true),
    'mls_dues' => get_user_meta($userID, 'mls_dues', true),
    'lease_purchase_payments' => get_user_meta($userID, 'lease_purchase_payments', true),
    'auto_insurance' => get_user_meta($userID, 'auto_insurance', true),
    'fuel' => get_user_meta($userID, 'fuel_expenses', true),
    'total_road_fees' => get_user_meta($userID, 'total_road_fees', true),
    'other_auto_expenses' => get_user_meta($userID, 'other_auto_expenses', true),
    'office_rent' => get_user_meta($userID, 'office_rent', true),
    'phone_internet_services' => get_user_meta($userID, 'phone_internet_services', true),
    'docusign' => get_user_meta($userID, 'docusign', true),
    'office_assistant_employee' => get_user_meta($userID, 'office_assistant_employee', true),
    'other_office_expenses' => get_user_meta($userID, 'other_office_expenses', true),
    'digital_suite_membership' => get_user_meta($userID, 'digital_suite_membership', true),
    'print_mail_campaigns' => get_user_meta($userID, 'print_mail_campaigns', true),
    'client_gifts' => get_user_meta($userID, 'client_gifts', true),
    'other_marketing_expenses' => get_user_meta($userID, 'other_marketing_expenses', true),
    'donation_expenses' => get_user_meta($userID, 'donation_expenses', true),
    'savings_investment' => get_user_meta($userID, 'savings_investment', true),
  ],
];

Timber::render( 'report/index.twig', $context );

function get_financial_goals_progress ($goal) {
  $values = ['$100k - $150k', '$150k - $250k', '$250k - $400k', '$400k - $600k', '$600k  '];  //  TODO: minor fix of the "+" symbol JS/PHP parsing
  return array_search($goal, $values) ? (array_search($goal, $values) + 1) * 20 : false;
}