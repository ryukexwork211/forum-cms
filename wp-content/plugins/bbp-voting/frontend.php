<?php
if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Enqueue Scripts

add_action('wp_enqueue_scripts', 'bbp_voting_styles');

function bbp_voting_styles() {
    wp_enqueue_style( 'bbp-voting-css', plugin_dir_url(__FILE__) . '/css/bbp-voting.css', array(), filemtime(plugin_dir_path(__FILE__) . 'css/bbp-voting.css') );
}

add_action('wp_enqueue_scripts', 'bbp_voting_scripts');

function bbp_voting_scripts() {
    if(function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
        // AMP = No JS
    } else {
        wp_enqueue_script( 'bbp-voting-js', plugin_dir_url(__FILE__) . '/js/bbp-voting.js', array('jquery'), filemtime(plugin_dir_path(__FILE__). 'js/bbp-voting.js') );
        wp_localize_script( 'bbp-voting-js', 'bbp_voting_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
}

// Vote Buttons and Score

// add_action('bbp_template_before_lead_topic', 'bbp_voting_buttons');
// add_action('bbp_theme_before_topic_author_details', 'bbp_voting_buttons');
// add_action('bbp_theme_before_reply_author_details', 'bbp_voting_buttons');
add_action('bbp_theme_before_topic_title', 'bbp_voting_buttons');
add_action('bbp_theme_before_topic_content', 'bbp_voting_buttons');
add_action('bbp_theme_before_reply_content', 'bbp_voting_buttons');

// add_filter('bbp_get_topic_author_link', 'bbp_voting_buttons', 9, 3);
// add_filter('bbp_get_reply_author_link', 'bbp_voting_buttons', 9, 3);

function bbp_voting_buttons() { // $author_link = '', $r = arrray(), $args = array()
    // global $bbp_voting_last_author_link_post_id;
    // $this_post_type = bbp_voting_get_current_post_type();
    $topic_post_type = bbp_get_topic_post_type();
    $reply_post_type = bbp_get_reply_post_type();
    if(current_action() === 'bbp_theme_before_topic_title' || current_action() == 'bbp_theme_before_topic_content') {
        // Topic hook will always be the topic
        $this_post_type = $topic_post_type;
    }
    if(current_action() === 'bbp_theme_before_reply_content') {
        // Reply hook could be topic (OP) or a reply
        $this_post_type = bbp_voting_get_current_post_type();
    }
    // Get the post
    if($this_post_type == $topic_post_type) $post = bbpress()->topic_query->post;
    if($this_post_type == $reply_post_type) $post = bbpress()->reply_query->post;
    // Do we have a post?
    if(!empty($post)) {
        $post_id = $post->ID;
        // Since we're using a filter on the author link, avoid duplicates
        // if($bbp_voting_last_author_link_post_id === $post_id) {
        //     // Duplicate
        //     return $author_link;
        // } else {
        //     // New, continue, but set the global variable
        //     $bbp_voting_last_author_link_post_id = $post_id;
        // }
        switch($this_post_type) {
            case $topic_post_type:
                $forum_id = bbp_get_topic_forum_id($post_id);
                $post_setting = get_post_meta( $forum_id, 'bbp_voting_forum_enable_topics', true);
                $broad_disable = apply_filters('bbp_voting_only_replies', false);
            break;
            case $reply_post_type:
                $forum_id = bbp_get_reply_forum_id($post_id);
                $post_setting = get_post_meta( $forum_id, 'bbp_voting_forum_enable_replies', true);
                $broad_disable = apply_filters('bbp_voting_only_topics', false);
            break;
        }
        if(!empty($post_setting)) {
            // Forum-specific override is set (not Default)
            if($post_setting === 'false') return;
        } else {
            // Use broad disable settings
            if($broad_disable === true) return;
        }
        // Filter Hook: 'bbp_voting_allowed_on_forum'
        if(!apply_filters('bbp_voting_allowed_on_forum', true, $forum_id)) return;
        // Done with "allowed" checks... let's do this
        $score = (int) get_post_meta($post_id, 'bbp_voting_score', true);
        $ups = (int) get_post_meta($post_id, 'bbp_voting_ups', true);
        $downs = (int) get_post_meta($post_id, 'bbp_voting_downs', true);
        // Check for, and correct, discrepancies
        $calc_score = $ups + $downs;
        if($score > $calc_score) {
            $diff = $score - $calc_score;
            $ups += $diff;
            update_post_meta($post_id, 'bbp_voting_ups', $ups);
        }
        // Get the weighted score
        // $weighted_score = get_post_meta($post_id, 'bbp_voting_weighted_score', true);
        // Get user's vote by ID or IP
        $voting_log = get_post_meta($post_id, 'bbp_voting_log', true);
        $voting_log = is_array($voting_log) ? $voting_log : array(); // Set up new array
        $client_ip = $_SERVER['REMOTE_ADDR'];
        $identifier = is_user_logged_in() ? get_current_user_id() : $client_ip;
        $existing_vote = array_key_exists($identifier, $voting_log) ? $voting_log[$identifier] : 0;
        // Admin bypass?
        $admin_bypass = current_user_can('administrator') && apply_filters('bbp_voting_admin_bypass', false);
        // View only score?
        // View only for visitors option
        $view_only = (!is_user_logged_in() && apply_filters('bbp_voting_disable_voting_for_visitors', false)) ? true : false;
        if(!$view_only) {
            // View only for closed topic option
            $topic_id = $this_post_type == $topic_post_type ? $post_id : bbp_get_reply_topic_id($post_id);
            $topic_status = get_post_status( $topic_id );
            $view_only = ($topic_status == 'closed' && apply_filters('bbp_voting_disable_voting_on_closed_topic', false)) ? true : false;
        }
        // Show labels?
        $show_labels = apply_filters('bbp_voting_show_labels', true);
        // Disable down votes?
        $disable_down = apply_filters('bbp_voting_disable_down_votes', false);
        // How to display vote numbers?
        $display_vote_nums = 'num-'. apply_filters('bbp_voting_display_vote_nums', 'hover');
        // Start HTML
        $html = '';
        $float = in_array(current_action(), ['bbp_theme_before_reply_content', 'bbp_theme_before_topic_content']);
        $html .= '<div class="bbp-voting bbp-voting-post-'.$post_id. ($view_only ? ' view-only' : ($existing_vote == 1 ? ' voted-up' : ($existing_vote == -1 ? ' voted-down' : ''))) . ($admin_bypass ? ' admin-bypass' : '') . ($float ? ' bbp-voting-float' : '') .'">';
        //adds the word 'helpful' in red above the arrow
        if($show_labels)
            $html .= '<div class="bbp-voting-label helpful">'.apply_filters('bbp_voting_helpful', 'Helpful').'</div>';
        if(function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) {
            // AMP = No JS
            $post_url = admin_url('admin-ajax.php');
            // Up vote
            $plusups = $ups ? '+'.$ups : ' ';
            $html .= '<form name="amp-form' . $post_id . '" method="post" action-xhr="'.$post_url.'" target="_top" on="submit-success: AMP.setState({\'voteup'. $post_id .'\': '.($ups + 1).'})">
                <input type="hidden" name="action" value="bbpress_post_vote_link_clicked">
                <input type="hidden" name="post_id" value="' . $post_id . '" />
                <input type="hidden" name="direction" value="1" />
                <input type="submit" class="nobutton upvote-amp" value="🔺" />
                <span class="vote up" [text]="voteup'. $post_id .' ? \'+\' + voteup'. $post_id .' : \''.$plusups.'\'">'.$plusups.'</span>
            </form>';
            // Display current vote count for post
            // $html .= '<div class="score">'. $score. '</div>';
            // $html .= '<div class="score" style="background-color: rgb('. floor((1 - $score) * 255). ', '.floor($score * 255).', 0); width:'.floor($score * 100).'%;"></div>';
            // Down vote
            if(!$disable_down) $html .= '<form name="amp-form' . $post_id . '" method="post" action-xhr="'.$post_url.'" target="_top" on="submit-success: AMP.setState({\'votedown'. $post_id .'\': '.($downs - 1).'})">
                <input type="hidden" name="action" value="bbpress_post_vote_link_clicked">
                <input type="hidden" name="post_id" value="' . $post_id . '" />
                <input type="hidden" name="direction" value="-1" />
                <input type="submit" class="nobutton downvote-amp" value="🔻" />
                <span class="vote down" [text]="votedown'. $post_id .' || \''.($downs ? $downs : ' ').'\'">'.($downs ? $downs : '').'</span>
            </form>';
        } else {
            // Normal JS AJAX version
            // Up vote
            $html .= '<a class="vote up '. $display_vote_nums .'" data-votes="'.($ups ? '+'.$ups : '').'" onclick="bbpress_post_vote_link_clicked(' . $post_id . ', 1); return false;">Up</a>';
            // Display current vote count for post
            $html .= '<div class="score">'. $score. '</div>';
            // Down vote
            if(!$disable_down) $html .= '<a class="vote down '. $display_vote_nums .'" data-votes="'.($downs ? $downs : '').'" onclick="bbpress_post_vote_link_clicked(' . $post_id . ', -1); return false;">Down</a>';
        }
        //adds the words 'not helpful' in red below the arrow
        if(!$disable_down && $show_labels)
            $html .= '<div class="bbp-voting-label not-helpful">'.apply_filters('bbp_voting_not_helpful', 'Not Helpful').'</div>';
        if($this_post_type == $reply_post_type)
            $html = apply_filters('bbp_voting_after_reply_voting_buttons', $html, $post_id);
        $html .= '</div>';
        // return $html . $author_link;
        echo $html;
    }
}

// Sort by Votes

add_filter('bbp_has_topics_query', 'sort_bbpress_posts_by_votes', 99);
add_filter('bbp_has_replies_query', 'sort_bbpress_posts_by_votes', 99);

function sort_bbpress_posts_by_votes( $args = array() ) {
    $forum_id = bbp_get_forum_id();
    if($forum_id === 0) return $args;
    // $this_post_type = isset($args['post_type']) ? $args['post_type'] : bbp_voting_get_current_post_type();
    // $this_post_type = bbp_voting_get_current_post_type();
    $forum_post_type = bbp_get_forum_post_type();
    $topic_post_type = bbp_get_topic_post_type();
    switch(current_filter()) {
        case 'bbp_has_topics_query':
            $this_post_type = $forum_post_type;
            $post_setting = get_post_meta( $forum_id, 'sort_bbpress_topics_by_votes_on_forum', true);
            $broad_enable = apply_filters('sort_bbpress_topics_by_votes', false);
        break;
        case 'bbp_has_replies_query':
            $this_post_type = $topic_post_type;
            $post_setting = get_post_meta( $forum_id, 'sort_bbpress_replies_by_votes_on_forum', true);
            $broad_enable = apply_filters('sort_bbpress_replies_by_votes', false);
        break;
        default:
            return $args;
    }
    // Do "allowed" checks
    if(isset($_GET['bbp-voting-sort'])) {
        // Sort dropdown used, skip the rest of the checks
        if($_GET['bbp-voting-sort'] === 'best') {
            // Proceed with score sorting
        } elseif($_GET['bbp-voting-sort'] === 'default' || $_GET['bbp-voting-sort'] === '') {
            // bbp default non-score sort
            return $args;
        }
    } else {
        // Sort dropdown not used... check the settings
        if(!empty($post_setting)) {
            // Forum-specific override is set (not Default)
            if($post_setting === 'false') return $args;
        } else {
            // Use broad disable settings
            if($broad_enable === false) return $args;
        }
        if(!apply_filters('bbp_voting_allowed_on_forum', true, $forum_id)) return $args;
    }
    // Done with "allowed" checks... let's do this
    // Filter the sort meta key.  Default = bbp_voting_score
    $sort_meta_key = apply_filters('bbp_voting_sort_meta_key', 'bbp_voting_score');

    // Reset for testing only -------------------------------------
    // $argsreset = $args;
    // $query = new WP_Query($argsreset);
    // foreach($query->posts as $reply) {
    //     delete_post_meta($reply->ID, $sort_meta_key); 
    // }
    // -----------------------------------
    
    // Find any replies that are missing the bbp_voting_score post meta and fill them with 0
    $args2 = $args;
    $args2['meta_query'] = [
        [
            'key' => $sort_meta_key,
            'compare' => 'NOT EXISTS',
            'value' => ''
        ],
    ];
    $query = new WP_Query($args2);
    foreach($query->posts as $reply) {
        $fill_in_default = apply_filters('bbp_voting_sort_meta_key_default_value', '0', $reply->ID);
        update_post_meta($reply->ID, $sort_meta_key, $fill_in_default);
    }

    // Now that all missing scores are filled in, we can sort the original args by the score
    // $args['meta_key'] = 'bbp_voting_score';
    // $args['orderby'] = [
    //     'post_type' => 'DESC', 
    //     'meta_value_num' => 'DESC',
    //     'date' => 'DESC'
    // ];
    unset($args['meta_key']);
    unset($args['meta_type']);
    unset($args['orderby']);
    unset($args['order']);
    $args['meta_query'] = [
        'relation' => 'AND',
        'score_clause' => [
            'key' => $sort_meta_key,
            'compare' => 'EXISTS',
            // 'type' => 'DECIMAL' // https://stackoverflow.com/questions/30018711/wordpress-meta-query-not-working-with-decimal-type
        ]
    ];
    if($sort_meta_key == 'bbp_voting_score') {
        $args['meta_query']['score_clause']['type'] = 'NUMERIC';
    }
    $args['orderby'] = [
        'post_type' => 'DESC', 
        'score_clause' => 'DESC'
    ];
    if($this_post_type === $topic_post_type) {
        // Add Date as another orderby for topics on a forum
        $args['orderby']['date'] = 'ASC';
    }
    if($this_post_type === $forum_post_type) {
        // Add Freshness as another orderby for topics on a forum
        $args['meta_query']['orderby_freshness'] = [
            'key' => '_bbp_last_active_time',
            'type' => 'DATETIME',
        ];
        $args['orderby']['orderby_freshness'] = 'DESC';
    }
    return $args;
}

add_action('init', 'bbp_voting_lead_topic');
function bbp_voting_lead_topic() {
    if(apply_filters('bbp_voting_lead_topic', false)) {
        add_filter('bbp_show_lead_topic', '__return_true');
    }
}