<?php
/**
 * Gamajo Google Geo Data.
 *
 * @package   Gamajo_Geo_Data
 * @author    Gary Jones
 * @link      http://gamajo.com/
 * @copyright 2014 Gary Jones, Gamajo Tech
 * @license   GPL-2.0+
 * @version   1.0.0
 */

/**
 * Plugin class.
 *
 * @package Gamajo_Geo_Data
 * @author  Gary Jones
 */
class Gamajo_Google_Geo_Data implements Gamajo_Geo_Data {

	protected $geo_address;
	protected $geo_data;

	/**
	 * Get geo data from remote Geocoding service.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $geo_address Address in human-readable form.
	 *
	 * @return stdClass Geodata.
	 */
	public function get_geo_data( $geo_address ) {
		if ( $this->geo_data && $this->geo_address == $geo_address ) {
			// Only return existing data if a new address has not been submitted.
			return $this->geo_data;
		}

		$url         = $this->build_url( $geo_address );
		$response    = wp_remote_get( $url );
		$json        = wp_remote_retrieve_body( $response );
		$geo_results = json_decode( $json );

		$this->geo_data = $geo_results->results[0]; // Only return first result for now

		return $this->geo_data;
	}

	/**
	 * Return latitude of given address.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $geo_address Address in human-readable form.
	 *
	 * @return float Latitude.
	 */
	public function get_latitude( $geo_address ) {
		$this->get_geo_data( $geo_address );
		return $this->geo_data->geometry->location->lat;
	}

	/**
	 * Return longitude of given address.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $geo_address Address in human-readable form.
	 *
	 * @return float Longitude.
	 */
	public function get_longitude( $geo_address ) {
		$this->get_geo_data( $geo_address );
		return $this->geo_data->geometry->location->lng;
	}

	/**
	 * Build URL for remote request for geodata.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $geo_address Address in human-readable format.
	 *
	 * @return string URL.
	 */
	protected function build_url( $geo_address ) {
		$url = "https://maps.googleapis.com/maps/api/geocode/json"; // v3
		$url = add_query_arg( 'address', urlencode( $geo_address ), $url );
		$url = add_query_arg( 'sensor', 'false', $url );
		// $url = add_query_arg( 'key', ..., $url ); // Need optional api key value

		// Adding country code to help perform more accurate geocoding
		// $cc_tld = array_pop( explode( '.', ... ) ); // Need domain value
		// if ( 'com' != $cc_tld ) {
			// $url = add_query_arg( 'region', $cc_tld, $url );
		// }

		return $url;
	}
}
