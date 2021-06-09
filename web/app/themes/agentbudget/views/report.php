<?php
/**
 * Template Name: Report
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

if ( !is_user_logged_in() ) {
  wp_redirect( home_url('login', 'relative') );
  exit;
} else {
  if ( !$context['user']['is_report_available'] ) {
    wp_redirect( home_url() );
    exit;
  }
}

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
  'recruiting' => [
    1 => [
      'agents' => get_user_meta($userID, 'recruiting_agents_level_1', true),
      'transactions' => get_user_meta($userID, 'recruiting_transactions_level_1', true),
      'highest_sold_price' => get_user_meta($userID, 'recruiting_highest_sold_price_level_1', true),
      'lowest_sold_price' => get_user_meta($userID, 'recruiting_lowest_sold_price_level_1', true),
      'revenue' => 0.02068
    ],
    2 => [
      'agents' => get_user_meta($userID, 'recruiting_agents_level_2', true),
      'transactions' => get_user_meta($userID, 'recruiting_transactions_level_2', true),
      'highest_sold_price' => get_user_meta($userID, 'recruiting_highest_sold_price_level_2', true),
      'lowest_sold_price' => get_user_meta($userID, 'recruiting_lowest_sold_price_level_2', true),
      'revenue' => 0.0188
    ],
    3 => [
      'agents' => get_user_meta($userID, 'recruiting_agents_level_3', true),
      'transactions' => get_user_meta($userID, 'recruiting_transactions_level_3', true),
      'highest_sold_price' => get_user_meta($userID, 'recruiting_highest_sold_price_level_3', true),
      'lowest_sold_price' => get_user_meta($userID, 'recruiting_lowest_sold_price_level_3', true),
      'revenue' => 0.0188
    ],
    4 => [
      'agents' => get_user_meta($userID, 'recruiting_agents_level_4', true),
      'transactions' => get_user_meta($userID, 'recruiting_transactions_level_4', true),
      'highest_sold_price' => get_user_meta($userID, 'recruiting_highest_sold_price_level_4', true),
      'lowest_sold_price' => get_user_meta($userID, 'recruiting_lowest_sold_price_level_4', true),
      'revenue' => 0.0094
    ],
    5 => [
      'agents' => get_user_meta($userID, 'recruiting_agents_level_5', true),
      'transactions' => get_user_meta($userID, 'recruiting_transactions_level_5', true),
      'highest_sold_price' => get_user_meta($userID, 'recruiting_highest_sold_price_level_5', true),
      'lowest_sold_price' => get_user_meta($userID, 'recruiting_lowest_sold_price_level_5', true),
      'revenue' => 0.0094
    ],
    6 => [
      'agents' => get_user_meta($userID, 'recruiting_agents_level_6', true),
      'transactions' => get_user_meta($userID, 'recruiting_transactions_level_6', true),
      'highest_sold_price' => get_user_meta($userID, 'recruiting_highest_sold_price_level_6', true),
      'lowest_sold_price' => get_user_meta($userID, 'recruiting_lowest_sold_price_level_6', true),
      'revenue' => 0.0047
    ],
    7 => [
      'agents' => get_user_meta($userID, 'recruiting_agents_level_7', true),
      'transactions' => get_user_meta($userID, 'recruiting_transactions_level_7', true),
      'highest_sold_price' => get_user_meta($userID, 'recruiting_highest_sold_price_level_7', true),
      'lowest_sold_price' => get_user_meta($userID, 'recruiting_lowest_sold_price_level_7', true),
      'revenue' => 0.00282
    ]
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
  ],
  'budgets' => [
    'tithing' => get_user_meta($userID, 'donation_expenses', true),
    'savings' => get_user_meta($userID, 'savings_investment', true),
    'marketing' => get_user_meta($userID, 'additional_marketing', true)
  ]
];

//  COUNT MY COMMISSION
$context['results']['my_commission'] = count_my_commission(
  $context['report']['direct_sales']['avg_price_per_sale'],
  $context['report']['direct_sales']['gross_commission_rate'],
  $context['report']['direct_sales']['brokerage_split_rate']
);

//  COUNT BROKERAGE SPLIT
$context['results']['brokerage_split'] = count_brokerage_split(
  $context['report']['direct_sales']['brokerage_split_rate']
);

//  COUNT NET COMMISSIONS
foreach ($context['report']['potential_income']['categories'] as $key => $value) {
  $listing_leads = $context['report']['potential_income']['categories'][$key]['listing_leads'];
  $buyer_leads = $context['report']['potential_income']['categories'][$key]['buyer_leads'];
  $success_rate = $context['report']['potential_income']['categories'][$key]['success_rate'];
  $context['results']['potential_income'][$key]['sold_transactions'] = count_sold_transactions(
    $listing_leads, $buyer_leads, $success_rate
  );
  $context['results']['potential_income'][$key]['lead_expense'] = count_expense_for_lead_ref(
    $listing_leads, $buyer_leads, $context['report']['potential_income']['lead_ref_expense']
  );
  $context['results']['potential_income'][$key]['closed_deal_ref_expense'] = count_closed_deal_ref_expense(
    $context['results']['potential_income'][$key]['sold_transactions'],
    $context['report']['potential_income']['closed_deal_ref_expense']
  );
  $context['results']['potential_income'][$key]['net_commission'] = count_net_commission(
    $context['results']['potential_income'][$key]['sold_transactions'],
    $context['report']['potential_income']['categories'][$key]['avg_listing_price'],
    $context['results']['brokerage_split'],
    $context['results']['potential_income'][$key]['lead_expense'],
    $context['results']['potential_income'][$key]['closed_deal_ref_expense']
  );
}

//  COUNT TOTAL NET COMMISSION
$context['results']['total_net_commission'] = 0;
foreach ($context['results']['potential_income'] as $key => $value) {
  $context['results']['total_net_commission'] += $context['results']['potential_income'][$key]['net_commission'];
}

//  COUNT RECRUITING COMMISSION
foreach ($context['report']['recruiting'] as $key => $value) {
  $agents = $context['report']['recruiting'][$key]['agents'];
  $transactions = $context['report']['recruiting'][$key]['transactions'];
  $highest_sold_price = $context['report']['recruiting'][$key]['highest_sold_price'];
  $lowest_sold_price = $context['report']['recruiting'][$key]['lowest_sold_price'];
  if ($agents && $transactions && $highest_sold_price && $lowest_sold_price) {
    $total_commission = get_recruited_agents_total_commission(
      $agents,
      $transactions,
      array_sum([
        parse_as_number($highest_sold_price),
        parse_as_number($lowest_sold_price)
      ]) / 2,
      parse_as_number($context['report']['direct_sales']['gross_commission_rate']) / 100
    );
    $context['results']['recruiting'][$key] = round($total_commission * $context['report']['recruiting'][$key]['revenue']);
  }
}

//  COUNT TOTAL RECRUITING COMMISSION
$context['results']['total_recruiting_commission'] = 0;
foreach ($context['results']['recruiting'] as $key => $value) {
  $context['results']['total_recruiting_commission'] += $context['results']['recruiting'][$key];
}

//  COUNT OPPORTUNITIES COMMISSION
foreach ($context['report']['opportunities'] as $key => $value) {
  $intros = $context['report']['opportunities'][$key]['introductions'];
  $success_rate = $context['report']['opportunities'][$key]['success_rate'];
  $closed_transaction = count_closed_transactions($intros, $success_rate);
  $context['results']['opportunities'][$key] = count_opportunity_commission(
    $closed_transaction,
    $context['report']['opportunities'][$key]['avg_cost'],
    $context['report']['opportunities'][$key]['commission'],
    $context['results']['brokerage_split']
  );
}

//  COUNT TOTAL OPPORTUNITIES COMMISSION
$context['results']['total_opportunities_commission'] = 0;
foreach ($context['results']['opportunities'] as $key => $value) {
  $context['results']['total_opportunities_commission'] += $context['results']['opportunities'][$key];
}

//  COUNT TOTAL EXPENSES
$context['results']['total_expenses'] = 0;
foreach ($context['report']['expenses'] as $key => $value) {
  $context['results']['total_expenses'] += parse_as_number($context['report']['expenses'][$key]);
}

$context['results']['total_net_income'] = count_total_net_income(
  $context['results']['total_net_commission'],
  $context['results']['total_recruiting_commission'],
  $context['results']['total_opportunities_commission']
);

$context['results']['net_income_minus_business_expenses'] = $context['results']['total_net_income'] - $context['results']['total_expenses'];

//  COUNT BUDGETS
foreach ($context['report']['budgets'] as $key => $value) {
  $context['results']['budgets'][$key] = count_budget(
    $context['results']['net_income_minus_business_expenses'],
    $context['report']['budgets'][$key]
  );
}

//  COUNT TOTAL BUDGETS
$context['results']['total_budgets'] = 0;
foreach ($context['results']['budgets'] as $key => $value) {
  $context['results']['total_budgets'] += $context['results']['budgets'][$key];
}

//  INCOME ESTIMATE
$context['income_estimate']['months_12'] = round($context['results']['net_income_minus_business_expenses'] - $context['results']['total_budgets']);
$context['income_estimate']['months_24'] = round($context['income_estimate']['months_12'] * 1.3);
$context['income_estimate']['months_60'] = round($context['income_estimate']['months_24'] * 1.3);

Timber::render( 'report/index.twig', $context );

function get_financial_goals_progress ($goal) {
  $values = ['$100k - $150k', '$150k - $250k', '$250k - $400k', '$400k - $600k', '$600k  '];
  return (array_search($goal, $values) + 1) * 20;
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

function get_recruited_agents_total_commission ($agents, $transactions, $avg_price, $gross_commission) {
  return ($agents * $transactions) * ($avg_price * $gross_commission);
}

function count_closed_transactions ($intros, $success_rate) {
  return $intros * parse_as_number($success_rate) / 100;
}

function count_opportunity_commission ($closed_transaction, $avg_total, $commission, $brokerage_split) {
  return round($closed_transaction * parse_as_number($avg_total) * $commission * $brokerage_split);
}

function count_total_net_income ($net, $recruiting, $opportunities) {
  return $net + $recruiting + $opportunities;
}

function count_budget ($net_income, $budget) {
  return $net_income * parse_as_number($budget) / 100;
}

function parse_as_number ($string) {
  return $string ? str_replace(['$', ',', '%'], '', $string) : 0;
}