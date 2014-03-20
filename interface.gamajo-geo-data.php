<?php
/**
 * Gamajo Geo Data.
 *
 * @package   Gamajo_Geo_Data
 * @author    Gary Jones <gary@gamajo.com>
 * @link      http://gamajo.com/
 * @copyright 2014 Gary Jones, Gamajo Tech
 * @license   GPL-2.0+
 * @version   1.0.0
 */

/**
 * Interface for geo data retrieval classes.
 *
 * @package Gamajo_Geo_Data
 * @author  Gary Jones <gary@gamajo.com>
 */
interface Gamajo_Geo_Data {
	/**
	 * Get geo data from remote Geocoding service.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $geo_address Address in human-readable form.
	 *
	 * @return stdClass Geodata.
	 */
	public function get_geo_data( $geo_address );

	/**
	 * Return latitude of given address.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $geo_address Address in human-readable form.
	 *
	 * @return float Latitude.
	 */
	public function get_latitude( $geo_address );

	/**
	 * Return longitude of given address.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $geo_address Address in human-readable form.
	 *
	 * @return float Longitude.
	 */
	public function get_longitude( $geo_address );
}
