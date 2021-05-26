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
    'brokerage_split_rate' => get_user_meta($userID, 'brokerage_split_rate', true),
  ],
  'potential_income' => [
    'lead_ref_expense' => get_user_meta($userID, 'lead_ref_expense', true),
    'closed_deal_ref_expense' => get_user_meta($userID, 'closed_deal_ref_expense', true),
    'categories' => [
      'hotel_concierge' => [
        'listing_leads' => get_user_meta($userID, 'hotel_concierge_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'hotel_concierge_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'hotel_concierge_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'divorce_attorneys' => [
        'listing_leads' => get_user_meta($userID, 'divorce_attorneys_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'divorce_attorneys_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'divorce_attorneys_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'wealth_managers' => [
        'listing_leads' => get_user_meta($userID, 'wealth_managers_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'wealth_managers_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'wealth_managers_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'vendors' => [
        'listing_leads' => get_user_meta($userID, 'vendors_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'vendors_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'vendors_success_rate', true),
        'avg_listing_price' => 1500000
      ],
      'core_support_team' => [
        'listing_leads' => get_user_meta($userID, 'core_support_team_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'core_support_team_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'core_support_team_success_rate', true),
        'avg_listing_price' => 1500000
      ],
      'social_media' => [
        'listing_leads' => get_user_meta($userID, 'social_media_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'social_media_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'social_media_success_rate', true),
        'avg_listing_price' => 700000
      ],
      'daily_cards' => [
        'listing_leads' => get_user_meta($userID, 'daily_cards_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'daily_cards_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'daily_cards_success_rate', true),
        'avg_listing_price' => 1000000
      ],
      'guard_gate' => [
        'listing_leads' => get_user_meta($userID, 'guard_gate_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'guard_gate_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'guard_gate_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'open_houses' => [
        'listing_leads' => get_user_meta($userID, 'open_houses_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'open_houses_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'open_houses_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'crm' => [
        'listing_leads' => get_user_meta($userID, 'crm_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'crm_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'crm_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'hoa' => [
        'listing_leads' => get_user_meta($userID, 'hoa_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'hoa_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'hoa_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'digital_suite' => [
        'listing_leads' => get_user_meta($userID, 'digital_suite_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'digital_suite_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'digital_suite_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'marketing_mail' => [
        'listing_leads' => get_user_meta($userID, 'marketing_mail_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'marketing_mail_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'marketing_mail_success_rate', true),
        'avg_listing_price' => 2500000
      ],
      'outside_agents' => [
        'listing_leads' => get_user_meta($userID, 'outside_agents_listing_leads', true),
        'buyer_leads' => get_user_meta($userID, 'outside_agents_buyer_leads', true),
        'success_rate' => get_user_meta($userID, 'outside_agents_success_rate', true),
        'avg_listing_price' => 2500000
      ]
    ]
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
      'commission' => 0.1
    ],
    'agent_smart_home' => [
      'introductions' => get_user_meta($userID, 'agent_smart_home_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_smart_home_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_smart_home_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_smart_home_avg_cost', true),
      'commission' => 0.1
    ],
    'agent_media' => [
      'introductions' => get_user_meta($userID, 'agent_media_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_media_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_media_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_media_avg_cost', true),
      'commission' => 0.1
    ],
    'agent_auction' => [
      'introductions' => get_user_meta($userID, 'agent_auction_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_auction_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_auction_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_auction_avg_cost', true),
      'commission' => 0.01
    ],
    'agent_inc' => [
      'introductions' => get_user_meta($userID, 'agent_inc_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_inc_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_inc_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_inc_avg_cost', true),
      'commission' => 0.0062
    ],
    'agent_commercial' => [
      'introductions' => get_user_meta($userID, 'agent_commercial_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_commercial_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_commercial_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_commercial_avg_cost', true),
      'commission' => 0.0062
    ],
    'agent_ranch' => [
      'introductions' => get_user_meta($userID, 'agent_ranch_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_ranch_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_ranch_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_ranch_avg_cost', true),
      'commission' => 0.0062
    ],
    'agent_property_management' => [
      'introductions' => get_user_meta($userID, 'agent_property_management_introductions', true),
      'success_rate' => get_user_meta($userID, 'agent_property_management_success_rate', true),
      'transactions' => get_user_meta($userID, 'agent_property_management_transactions', true),
      'avg_cost' => get_user_meta($userID, 'agent_property_management_avg_cost', true),
      'commission' => 0.0062
    ]
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

//  COUNT MY COMMISSION
$context['report']['results']['my_commission'] = count_my_commission(
  $context['report']['direct_sales']['avg_price_per_sale'],
  $context['report']['direct_sales']['gross_commission_rate'],
  $context['report']['direct_sales']['brokerage_split_rate']
);

//  COUNT BROKERAGE SPLIT
$context['report']['results']['brokerage_split'] = count_brokerage_split(
  $context['report']['direct_sales']['brokerage_split_rate']
);

//  COUNT NET COMMISSIONS
foreach ($context['report']['potential_income']['categories'] as $key => $value) {
  $listing_leads = $context['report']['potential_income']['categories'][$key]['listing_leads'];
  $buyer_leads = $context['report']['potential_income']['categories'][$key]['buyer_leads'];
  $success_rate = $context['report']['potential_income']['categories'][$key]['success_rate'];
  $context['report']['results']['potential_income'][$key]['sold_transactions'] = count_sold_transactions(
    $listing_leads, $buyer_leads, $success_rate
  );
  $context['report']['results']['potential_income'][$key]['lead_expense'] = count_expense_for_lead_ref(
    $listing_leads, $buyer_leads, $context['report']['potential_income']['lead_ref_expense']
  );
  $context['report']['results']['potential_income'][$key]['closed_deal_ref_expense'] = count_closed_deal_ref_expense(
    $context['report']['results']['potential_income'][$key]['sold_transactions'],
    $context['report']['potential_income']['closed_deal_ref_expense']
  );
  $context['report']['results']['potential_income'][$key]['net_commission'] = count_net_commission(
    $context['report']['results']['potential_income'][$key]['sold_transactions'],
    $context['report']['potential_income']['categories'][$key]['avg_listing_price'],
    $context['report']['results']['brokerage_split'],
    $context['report']['results']['potential_income'][$key]['lead_expense'],
    $context['report']['results']['potential_income'][$key]['closed_deal_ref_expense']
  );
}

//  COUNT TOTAL NET COMMISSION
$total_net_commission = 0;
foreach ($context['report']['results']['potential_income'] as $key => $value) {
  $total_net_commission = $total_net_commission + $context['report']['results']['potential_income'][$key]['net_commission'];
}
$context['report']['results']['total_net_commission'] = $total_net_commission;

//  COUNT TOTAL OPPORTUNITIES
foreach ($context['report']['opportunities'] as $key => $value) {
  $intros = $context['report']['opportunities'][$key]['introductions'];
  $success_rate = $context['report']['opportunities'][$key]['success_rate'];
  $closed_transaction = count_closed_transactions($intros, $success_rate);
  $context['report']['results']['opportunities'][$key] = count_opportunity_income(
    $closed_transaction,
    $context['report']['opportunities'][$key]['avg_cost'],
    $context['report']['opportunities'][$key]['commission'],
    $context['report']['results']['brokerage_split']
  );
}

//  COUNT TOTAL OPPORTUNITIES COMMISSION
$total_opportunities_commission = 0;
foreach ($context['report']['results']['opportunities'] as $key => $value) {
  $total_opportunities_commission = $total_opportunities_commission + $context['report']['results']['opportunities'][$key];
}
$context['report']['results']['total_opportunities_commission'] = $total_opportunities_commission;

//var_dump($context['report']['results']['total_opportunities_commission']);

Timber::render( 'report/index.twig', $context );

function get_financial_goals_progress ($goal) {
  $values = ['$100k - $150k', '$150k - $250k', '$250k - $400k', '$400k - $600k', '$600k  '];  //  TODO: minor fix of the "+" symbol JS/PHP parsing
  return array_search($goal, $values) ? (array_search($goal, $values) + 1) * 20 : false;
}

function count_my_commission ($average_price, $gross_commission_rate, $brokerage_split_rate, $my_market_share = 12.25) {
  $sales_volume = $my_market_share * parse_as_number($average_price);
  $gross_commission = $sales_volume * parse_as_number($gross_commission_rate) / 100;
  $brokerage_split = $gross_commission * parse_as_number($brokerage_split_rate) / 100;
  return round($gross_commission - $brokerage_split);
}

function count_sold_transactions ($listing_leads, $buyer_leads, $success_rate) {
  return ($listing_leads + $buyer_leads) * parse_as_number($success_rate) / 100;
}

function count_expense_for_lead_ref ($listing_leads, $buyer_leads, $avg_expense) {
  return ($listing_leads + $buyer_leads) * parse_as_number($avg_expense);
}

function count_closed_deal_ref_expense ($sold_transactions, $avg_expense) {
  return $sold_transactions * parse_as_number($avg_expense);
}

function count_brokerage_split ($split_rate) {
  return (100 - parse_as_number($split_rate)) / 100;
}

function count_net_commission ($sold_transactions, $avg_price, $brokerage_split, $lead_expense, $closed_deal_expense, $commission = 0.0247 ) {
  return round(($sold_transactions * $avg_price * $brokerage_split * $commission) - $lead_expense - $closed_deal_expense);
}

function count_closed_transactions ($intros, $success_rate) {
  return $intros * parse_as_number($success_rate) / 100;
}

function count_opportunity_income ($closed_transaction, $avg_total, $commission, $brokerage_split) {
  return round($closed_transaction * parse_as_number($avg_total) * $commission * $brokerage_split);
}

function parse_as_number ($string) {
  return $string ? str_replace(['$', ',', '%'], '', $string) : 0;
}