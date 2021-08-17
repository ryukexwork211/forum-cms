=== bbPress Voting ===
Contributors: natekinkead
Donate link: https://paypal.me/natekinkead
Tags: bbpress, voting, vote, rating, rate, topics, replies, up, down, score, stackoverflow, reddit, forum
Requires at least: 4.0
Tested up to: 5.7.2
Stable tag: 2.1.9.7
Requires PHP: 5.6
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Let visitors vote up and down on bbPress topics and replies just like Reddit or Stack Overflow!

== Description ==

This simple yet powerful plugin integrates with the bbPress forum plugin to add a new feature which allows users or visitors to vote up or down on topics and replies.  Each topic and reply has a total score with an up arrow and a down arrow.

This plugin uses AJAX to save the vote on-the-fly without refreshing the page.

It's also AMP compatible!

Visitors can only vote once on each topic or reply.

Features Included:
* Show or hide (and customize) labels for up and down
* Disable voting on topics or replies globally
* Disable voting on specific forums
* View-only score on closed topics
* Sort topics and replies by voting scores
* Admin bypass

Pro Features Available:
* Accepted answers
* "Who voted" avatars
* Sort dropdown
* Sort on weighted score
* Trending topics widget
* Schema for Q&A rich snippets
* Voting email notification to author

Purchase bbPress Voting Pro at [WP For The Win](https://wpforthewin.com/product/bbpress-voting-pro/)!

== Installation ==

1. Just install and activate

== Frequently Asked Questions ==

= Are there other plugins like this?

No, and it's the strangest thing.  I was wanting a plugin to do this, and after much seaching, I came to the conclusion that it didn't exist, so I developed one myself.

= How to you change the settings?

In the WordPress admin area, go to Settings > bbPress Voting

= How do you hook into the function that saves the vote to write custom code?

This hook fires after a new vote has been saved.

`add_action( 'bbp_voting_voted', 'my_function_on_bbp_vote', 10, 4 );
function my_function_on_bbp_vote( $post_id, $direction, $score, $identifier ) {
    // Do something
    // $post_id will be the ID of the topic or reply that was voted on
    // $direction will be 1 for upvote, -1 for downvote, or 0 for removed vote
    // $score will be the new total score
    // $identifier will be either a numeric user ID or an IP address of a non-logged-in visitor
}`

= How do you allow voting only on certain forums?

Edit the forum, and you will see a metabox on the sidebar that will let you enable or disable voting and/or sorting just on that forum.

You can also write custom code to do it.  This function in your child theme's functions.php file will let you choose which forum IDs are allowed to have voting...

`add_filter( 'bbp_voting_allowed_on_forum', 'allowed_voting_forums', 10, 2 );
function allowed_voting_forums( $allowed, $forum_id ) {
    if( in_array( $forum_id, array(123, 124, 125) ) ) {
        $allowed = true;
    } else {
        $allowed = false;
    }
    return $allowed;
}`

= Can you allow administrators to vote repeatedly without limitations?

By default nobody can vote repeatedly on the same topic or reply, but you can enable this only for administrators by enabling the "Admin Bypass" settings.

== Screenshots ==

1. Voting and scores on a topics list in a forum.

2. Voting and scores on a reply on a topic.

3. Settings Page

4. Settings Page (continued)

5. Override voting and sorting on topics and replies on individual forums.

== Changelog ==

= 2.1.9.7 =
* Added option to disallow authors from voting on their own topics/replies.

= 2.1.9.6 =
* Fixed removing down label when downvotes disabled.

= 2.1.9.5 =
* Update to the "Go Pro!" page.  Check out all the new features in the Pro version!

= 2.1.9.3 =
* Added option to break out the lead topic from the replies.

= 2.1.9 =
* Fixes issue with bbPress where topic moves to the bottom when "nested/threaded replies" is enabled.

= 2.1.6 =
* Pro version now has schema for Q&A rich snippets!
* Fixed sorting with threaded replies
* Now uses lead topic area before the replies

= 2.1.4 =
* test

= 2.1.3 =
* Bug fix for sorting by date after scores.

= 2.1.2 =
* Bug fix
* Combined settings onto one tab

= 2.1.1 =
* bbPress Voting Pro now has a Trending Topics widget that sorts based on voting score.

= 2.1.0 =
* New option to choose how to display vote numbers (hover, always show, or hide).
* New option to choose how to display vote numbers.
* New option for the pro feature, Accepted Answers.
* New pro feature, "Sort by" Dropdown.

= 2.0.8 =
* Support for Pro version 2.0.8, now with Accepted Answers!

= 2.0.7 =
* Fixed view-only voting scores on closed topics
* Fixed javascript error in case of unexpected AJAX response
* Made AJAX object variable name specific to prevent issues with other plugins that change the ajax_url property to ajaxurl.

= 2.0.6 =
* New option for view-only voting for visitors (not logged in)
* Now option for disabling down votes
* Improved AJAX error handling.
* Fixed bug with topic/reply post type detection

= 2.0.5 =
* Settings and hooks to allow a new feature in bbPress Voting... Sorting by weighted score.
* Improved AJAX data response for placing a vote.

= 2.0.4 =
* version bump.

= 2.0.3 =
* bbp_voting_voted hook now will pass $direction = 0 when the user removed their vote.

= 2.0.2 =
* Fix for better post_type detection
* Fix for issue with BuddyBoss Theme

= 2.0.1 =
* New support for BuddyBoss Theme!
* Bug fix for (user profile > replies created) showing empty.

= 2.0.0 =
* New bbPress Voting Pro plugin is now available.  "Who voted" avatars and author email notifications have moved to the Pro plugin.  Get it at https://wpforthewin.com/product/bbpress-voting-pro/

= 1.4.4 =
* New ability to remove your vote

= 1.4.3 =
* Bug fixes

= 1.4.2 =
* Bug fixes

= 1.4.1 =
* Bug fixes

= 1.4.0 =
* New "who voted" feature which shows color-coded avatars of users who voted on a topic or reply.  Enable it in the settings.
* New "author email notification" feature which emails the author of a topic or reply when a logged in user votes on it.  Enable it in the settings.

= 1.3.5 =
* Fixed forum-specific overrides when using the shortcode.

= 1.3.4 =
* Added setting to for view-only scores on closed topics.
* Fixed styling when using admin bypass

= 1.3.3 =
* Fix bug with sort order of topics on a forum view.

= 1.3.2 =
* Fix bug with sort order of topics on a forum view.

= 1.3.1 =
* Fix bug with get_post_type() not working to get the reply ID on some themes.

= 1.3.0 =
* New settings page!  No more need for hooks.
* Enable or disable voting on topics and/or replies.
* Enable or disable sorting by votes on topics and/or replies.
* Override voting and sorting on topics and replies on individual forums.

= 1.2.9 =
* Bug fix with bbp_voting_allowed_on_forum hook.

= 1.2.8 =
* Bug fix.

= 1.2.7 =
* Removed needless specificity on jQuery selector

= 1.2.6 =
* Fix bug that allowed illusion of voting repeatedly.
* Added support for reversing your vote.

= 1.2.5 =
* Don't sort by votes when voting is not allowed on that forum.

= 1.2.4 =
* Added action into the bbp_template_before_lead_topic hook.

= 1.2.3 =
* Added action into the bbp_theme_before_topic_author_details hook.

= 1.2.2 =
* Added vote tracking by user ID when logged in and fallback to IP when not logged in.

= 1.2.1 =
* Fix CSS compatibility issue with bbPress 2.6 RC 7
* Added filter hook for bbp_voting_only_replies

= 1.2.0 =
* New features release!  See the FAQs for several new hooks to access the new features.
* Now AMP compatible
* Double vote tracking now uses IPs rather than browser cookie
* Your current vote shows with a green up arrow or a red down arrow
* Show only on topics, not replies
* Allow voting only on certain forums
* New admin bypass filter

= 1.1.7 =
* Another bug fix with sorting replies by voting score

= 1.1.6 =
* Bug fix with sorting replies by voting score

= 1.1.5 =
* Added filter, sort_bbpress_replies_by_votes, to enable a new feature that sorts replies by voting score

= 1.1.4 =
* Added filter, bbp_voting_show_labels

= 1.1.3 =
* Removed unlimited voting from administrators

= 1.1.2 =
* Fixed javascript bug with repeated votes
* Added Helpful and Not Helpful labels with filters to modify them

= 1.1.1 =
* Added hover effect to show the up and down votes

= 1.1.0 =
* Added tracking of up votes and down votes
* Added hover style on arrows
* Bug fixes

= 1.0.3 =
* Fixed jquery bug

= 1.0.2 =
* Bug fix with nopriv AJAX

= 1.0.1 =
* Bug fix

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 2.0.5 =
Upgrade to receive a bugfix with the admin bypass feature.  Also, checkout my bbPress Voting Pro plugin for even more awesome features!