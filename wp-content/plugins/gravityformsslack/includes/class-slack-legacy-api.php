<?php

namespace Gravity_Forms\Gravity_Forms_Slack;

use GF_Slack_API;

/**
 * Class containing legacy API calls.
 *
 * This object gets instantiated when a site has not yet re-authenticated with the Slack API. It holds calls to deprecated
 * endpoints for the purposes of backward compatibility, each of which will fail once Slack fully drops support.
 *
 * This class has been deprecated and will be removed in a future release.
 *
 * @since 1.13
 *
 * @deprecated
 */
class Slack_Legacy_API extends GF_Slack_API {
	/**
	 * Get a channel.
	 *
	 * @since  1.0
	 * @access public
	 * @param  string $channel Channel name.
	 *
	 * @return array
	 */
	public function get_channel( $channel ) {
		return $this->make_request( 'channels.info', array( 'channel' => $channel ) );
	}

	/**
	 * Get all channels.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_channels() {
		return $this->make_request( 'channels.list' );
	}

	/**
	 * Get a group.
	 *
	 * @since  1.0
	 * @access public
	 * @param  string $group Group ID.
	 *
	 * @return array
	 */
	public function get_group( $group ) {
		return $this->make_request( 'groups.info', array( 'channel' => $group ) );
	}


	/**
	 * Get all groups.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_groups() {
		return $this->make_request( 'groups.list' );
	}
}
