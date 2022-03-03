<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase

/**
 * Class AjaxHandler.
 *
 * @package ImArun\Calculator
 * @author  Arun Sharma <dextorlobo@gmail.com>
 * @version 1.0.0
 * @access public
 */

namespace ImArun\Calculator\Inc;

/**
 * Class AjaxHandler
 */
class AjaxHandler {

	/**
	 * Method init.
	 */
	public function init() { 
		add_action( 'wp_ajax_land_tax_ajax_function', array( $this, 'land_tax_ajax_function' ) );
		add_action( 'wp_ajax_stamp_duty_ajax_function', array( $this, 'stamp_duty_ajax_function' ) );
	}

	/**
	 * Land tax ajax function
	 */
	public function land_tax_ajax_function() { 
		$year       = isset( $_REQUEST['year'] ) ? $_REQUEST['year'] : null;
		$surcharge  = isset( $_REQUEST['surcharge'] ) ? $_REQUEST['surcharge'] : null;
		$purposes   = isset( $_REQUEST['purposes'] ) ? $_REQUEST['purposes'] : null;
		$tax_year   = isset( $_REQUEST['taxYear'] ) ? $_REQUEST['taxYear'] : null;
		$land_value = isset( $_REQUEST['land_value'] ) ? $_REQUEST['land_value'] : null;

		$purposes   = $purposes - $land_value;
		if ( $surcharge > 0 ) {
			$csurcharge = $surcharge * ( 2 / 100 );
		} else {
			$csurcharge = 0;
		}
		if ( NSW == $year ) {
			if ( 2021 == $tax_year ) {
				$taxper = 0.402;
			}
			if ( 2020 == $tax_year ) {
				$taxper = 0.435;
			}
			if ( 2019 == $tax_year ) {
				$taxper = 0.502;
			}
			if ( 2018 == $tax_year ) {
				$taxper = 0.603;
			}
			if ( 2017 == $tax_year ) {
				$taxper = 0.731;
			}
			if ( 2016 == $tax_year ) {
				$taxper = 0.838;
			}
			$cpurpose = $purposes * $taxper / 100;
			$cpurpose = round( $cpurpose, 2 );
		}
		if ( WA == $year ) {
			if ( $purposes < 300001 ) {
				$cpurpose = 0;
			}
			if ( $purposes > 300000 && $purposes < 420001 ) {
				$cpurpose = 300;
			}
			if ( $purposes > 420000 && $purposes < 1000001 ) {
				$cpurpose = $purposes - 420000;
				$cpurpose = 300 + ( $cpurpose * 0.25 / 100 );
			}
			if ( $purposes > 1000000 && $purposes < 1800001 ) {
				$cpurpose = $purposes - 1000000;
				$cpurpose = 1750 + ( $cpurpose * 0.90 / 100 );
			}
			if ( $purposes > 1800000 && $purposes < 5000001 ) {
				$cpurpose = $purposes - 1800000;
				$cpurpose = 8950 + ( $cpurpose * 1.80 / 100 );
			}
			if ( $purposes > 5000000 && $purposes < 11000001 ) {
				$cpurpose = $purposes - 5000000;
				$cpurpose = 66550 + ( $cpurpose * 2.00 / 100 );
			}
			if ( $purposes > 11000000 ) {
				$cpurpose = $purposes - 11000000;
				$cpurpose = 186550 + ( $cpurpose * 2.67 / 100 );
			}
			$cpurpose = round( $cpurpose, 2 );
		}
		if ( $year == NT ) {
			$cpurpose = 0;
		}
		if ( $year == VIC ) {
			if ( $purposes < 250001 ) {
				$cpurpose = 0;
			}
			if ( $purposes > 250000 && $purposes < 600001 ) {
				$cpurpose = $purposes - 250000;
				$cpurpose = 275 + ( $cpurpose * 0.2 / 100 );
			}
			if ( $purposes > 600000 && $purposes < 1000001 ) {
				$cpurpose = $purposes - 600000;
				$cpurpose = 975 + ( $cpurpose * 0.5 / 100 );
			}
			if ( $purposes > 1000000 && $purposes < 1800001 ) {
				$cpurpose = $purposes - 1000000;
				$cpurpose = 2975 + ( $cpurpose * 0.8 / 100 );
			}
			if ( $purposes > 1800000 && $purposes < 3000001 ) {
				$cpurpose = $purposes - 1800000;
				$cpurpose = 9375 + ( $cpurpose * 1.3 / 100 );
			}
			if ( $purposes > 3000000 ) {
				$cpurpose = $purposes - 3000000;
				$cpurpose = 24975 + ( $cpurpose * 2.25 / 100 );
			}
			$cpurpose = round( $cpurpose, 2 );
		}
		if ( $year == TAS ) {
			if ( $purposes <= 49999.99 ) {
				$cpurpose = 0;
			}
			if ( $purposes > 49999.99 && $purposes < 399999.99 ) {
				$cpurpose = $purposes - 50000;
				$cpurpose = 50 + ( $cpurpose * 0.55 / 100 );
			}
			if ( $purposes > 399999.99 ) {
				$cpurpose = $purposes - 400000;
				$cpurpose = 1975 + ( $cpurpose * 1.5 / 100 );
			}
			$cpurpose = round( $cpurpose, 2 );
		}
		if ( $year == SA ) {
			if ( $purposes < 450001 ) {
				$cpurpose = 0;
			}
			if ( $purposes > 450000 && $purposes < 723001 ) {
				$cpurpose = $purposes - 450000;
				$cpurpose = ( $cpurpose * 0.5 / 100 );
			}
			if ( $purposes > 723000 && $purposes < 1052001 ) {
				$cpurpose = $purposes - 723000;
				$cpurpose = 1365 + ( $cpurpose * 1.25 / 100 );
			}
			if ( $purposes > 1052000 && $purposes < 1350001 ) {
				$cpurpose = $purposes - 1052000;
				$cpurpose = 5477 + ( $cpurpose * 2 / 100 );
			}
			if ( $purposes > 1350000 ) {
				$cpurpose = $purposes - 1350000;
				$cpurpose = 10852.50 + ( $cpurpose * 2.40 / 100 );
			}
			$cpurpose = round( $cpurpose, 2 );
		}
		if ( $year == QLD ) {
			if ( $purposes < 600000 ) {
				$cpurpose = 0;
			}
			if ( $purposes >= 600000 && $purposes < 1000000 ) {
				$cpurpose = $purposes - 600000;
				$cpurpose = ( $cpurpose * 0.1 / 100 );
			}
			if ( $purposes >= 1000000 && $purposes < 3000000 ) {
				$cpurpose = $purposes - 1000000;
				$cpurpose = 4500 + ( $cpurpose * 1.65 / 100 );
			}
			if ( $purposes >= 3000000 && $purposes < 5000000 ) {
				$cpurpose = $purposes - 3000000;
				$cpurpose = 37500 + ( $cpurpose * 1.25 / 100 );
			}
			if ( $purposes >= 5000000 && $purposes < 10000000 ) {
				$cpurpose = $purposes - 5000000;
				$cpurpose = 62500 + ( $cpurpose * 1.75 / 100 );
			}
			if ( $purposes >= 10000000 ) {
				$cpurpose = $purposes - 10000000;
				$cpurpose = 150000 + ( $cpurpose * 2.25 / 100 );
			}
			$cpurpose = round( $cpurpose, 2 );
		}
		if ( $year == ACT ) {
			if ( $purposes < 150000 ) {
				$cpurpose = ( $purposes * 0.54 / 100 );
			}
			if ( $purposes >= 150000 && $purposes < 275000 ) {
				$cpurpose = $purposes - 150000;
				$cpurpose = 810 + ( $cpurpose * 0.64 / 100 );
			}
			if ( $purposes >= 275000 && $purposes < 2000001 ) {
				$cpurpose = $purposes - 275000;
				$cpurpose = 1610 + ( $cpurpose * 1.12 / 100 );
			}
			if ( $purposes >= 2000000 ) {
				$cpurpose = $purposes - 2000000;
				$cpurpose = 20930 + ( $cpurpose * 1.14 / 100 );
			}
			$cpurpose = round( $cpurpose, 2 );
		}
		$csurcharge = round( $csurcharge, 2 );
		wp_send_json_success(
			array(
				'land_tax_state' => $year,
				'cpurpose' => $cpurpose, 
				'csurcharge' => $csurcharge, 
				'total' => $cpurpose + $csurcharge,
			), 
			200
		);
	}

	/**
	 * Stamp duty ajax function
	 */
	public function stamp_duty_ajax_function() {
		$typ       = $_REQUEST['typ'];
		$year      = $_REQUEST['year'];
		$surcharge = $_REQUEST['surcharge'];
		$purposes  = $_REQUEST['purposes'];
		$buy1      = $_REQUEST['buy1'];
		$buy1      = $_REQUEST['buy1'];
		$purc      = $_REQUEST['purc'];
		$surcharge = $_REQUEST['surcharge'];

		if ($surcharge == yes) {
			$csurcharge = $purposes * (8 / 100);
		} else {
			$csurcharge = 0;
		}
		if ($year == NSW) {
			if ($purposes > 9 && $purposes < 14000) {
				$npurposes = $purposes / 100;
				$cpurpose  = $npurposes * 1.25;
			}
			if ($purposes >= 14000 && $purposes < 32000) {
				$purposes1 = $purposes - 14000;
				$npurposes = $purposes1 / 100;
				$cpurpose  = ($npurposes * 1.50) + 175;
			}
			if ($purposes >= 32000 && $purposes < 85000) {
				$purposes1 = $purposes - 32000;
				$npurposes = $purposes1 / 100;
				$cpurpose  = ($npurposes * 1.75) + 445;
			}
			if ($purposes >= 85000 && $purposes < 319000) {
				$purposes1 = $purposes - 85000;
				$npurposes = $purposes1 / 100;
				$cpurpose  = ($npurposes * 3.50) + 1372;
			}
			if ($purposes >= 319000 && $purposes < 1064000) {
				$purposes1 = $purposes - 319000;
				$npurposes = $purposes1 / 100;
				$cpurpose  = ($npurposes * 4.50) + 9562;
			}
			if ($purposes > 1064000) {
				$purposes1 = $purposes - 1064000;
				$npurposes = $purposes1 / 100;
				$cpurpose  = ($npurposes * 5.50) + 43087;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc != "Established") {
				$FOG      = 10000;
				$cpurpose = 0;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG      = 0;
				$cpurpose = 0;
			}
		}
		if ($year == NT) {
			if ($purposes < 525000) {
				$purposes1 = 0.06571441 * $purposes;
				$purposes2 = ($purposes1 * 2) / 1000;
				$purposes3 = $purposes2 * $purposes;
				$purposes4 = ($purposes3 * 2) / 1000;
				$purposes5 = ($purposes4 * 25) / 100;
				$tpur      = ($purposes * 15) / 1000;
				$cpurpose  = $purposes5 + $tpur;
				$cpurpose  = round($cpurpose, 2);
			}
			if ($purposes > 525000 && $purposes < 3000000) {
				$purposes1 = ($purposes * 4.95) / 100;
				$cpurpose  = round($purposes1, 2);
			}
			if ($purposes > 30000001 && $purposes < 5000000) {
				$purposes1 = ($purposes * 5.75) / 100;
				$cpurpose  = round($purposes1, 2);
			}
			if ($purposes > 5000000) {
				$purposes1 = ($purposes * 5.95) / 100;
				$cpurpose  = round($purposes1, 2);
			}
			if ($buy1 == yes && $typ != "Investment" && $purc != "Established") {
				$FOG      = 10000;
				$cpurpose = $cpurpose;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
		}
		if ($year == QLD) {
			if ($purposes < 5000) {
				$cpurpose = 0;
			}
			if ($purposes > 5000 && $purposes < 75001) {
				$cpurpose = ($purposes * 1.5) / 100;
			}
			if ($purposes > 75000 && $purposes < 540001) {
				$purposes1 = $purposes - 75000;
				$cpurpose  = (($purposes1 * 3.5) / 100) + 1050;
			}
			if ($purposes > 540000 && $purposes < 1000001) {
				$purposes1 = $purposes - 540000;
				$cpurpose  = (($purposes1 * 4.5) / 100) + 17325;
			}
			if ($purposes > 1000000) {
				$purposes1 = $purposes - 1000000;
				$cpurpose  = (($purposes1 * 5.75) / 100) + 38025;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'New Home') {
				$FOG      = 15000;
				$cpurpose = 0;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG      = 0;
				$cpurpose = 0;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'Vacant Land') {
				$FOG = 15000;
			}
		}
		if ($year == SA) {
			if ($purposes <= 12000) {
				$cpurpose = ($purposes / 100) * 1;
			}
			if ($purposes > 12000 && $purposes < 30000) {
				$purposes1 = $purposes - 12000;
				$cpurpose  = (($purposes1 / 100) * 2) + 120;
			}
			if ($purposes > 30000 && $purposes < 50000) {
				$purposes1 = $purposes - 30000;
				$cpurpose  = (($purposes1 / 100) * 3) + 480;
			}
			if ($purposes > 50000 && $purposes < 100000) {
				$purposes1 = $purposes - 50000;
				$cpurpose  = (($purposes1 / 100) * 3.5) + 1080;
			}
			if ($purposes > 100000 && $purposes < 200000) {
				$purposes1 = $purposes - 100000;
				$cpurpose  = (($purposes1 / 100) * 4) + 2830;
			}
			if ($purposes > 200000 && $purposes < 250000) {
				$purposes1 = $purposes - 200000;
				$cpurpose  = (($purposes1 / 100) * 4.25) + 6830;
			}
			if ($purposes > 250000 && $purposes < 300000) {
				$purposes1 = $purposes - 250000;
				$cpurpose  = (($purposes1 / 100) * 4.75) + 8955;
			}
			if ($purposes > 300000 && $purposes < 500000) {
				$purposes1 = $purposes - 300000;
				$cpurpose  = (($purposes1 / 100) * 5) + 11330;
			}
			if ($purposes > 500000) {
				$purposes1 = $purposes - 500000;
				$cpurpose  = (($purposes1 / 100) * 5.5) + 21330;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'New Home') {
				$FOG = 15000;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'Vacant Land') {
				$FOG = 0;
			}
		}
		if ($year == TAS) {
			if ($purposes <= 3000) {
				$cpurpose = 50;
			}
			if ($purposes > 3000 && $purposes < 25000) {
				$purposes1 = $purposes - 3000;
				$cpurpose  = (($purposes1 / 100) * 1.75) + 50;
			}
			if ($purposes > 25000 && $purposes < 75000) {
				$purposes1 = $purposes - 25000;
				$cpurpose  = (($purposes1 / 100) * 2.25) + 435;
			}
			if ($purposes > 75000 && $purposes < 200000) {
				$purposes1 = $purposes - 75000;
				$cpurpose  = (($purposes1 / 100) * 3.5) + 1560;
			}
			if ($purposes > 200000 && $purposes < 375000) {
				$purposes1 = $purposes - 200000;
				$cpurpose  = (($purposes1 / 100) * 4) + 5935;
			}
			if ($purposes > 375000 && $purposes < 725000) {
				$purposes1 = $purposes - 375000;
				$cpurpose  = (($purposes1 / 100) * 4.25) + 12935;
			}
			if ($purposes > 725000) {
				$purposes1 = $purposes - 725000;
				$cpurpose  = (($purposes1 / 100) * 4.5) + 27810;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'New Home') {
				$FOG = 30000;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'Vacant Land') {
				$FOG = 30000;
			}
		}
		if ($year == VIC) {
			if ($purposes <= 25000) {
				$cpurpose = ($purposes * 1.4) / 100;
			}
			if ($purposes > 25000 && $purposes < 130000) {
				$purposes1 = $purposes - 25000;
				$cpurpose  = (($purposes1 / 100) * 2.4) + 350;
			}
			if ($purposes > 130000 && $purposes < 960000) {
				$purposes1 = $purposes - 130000;
				$cpurpose  = (($purposes1 / 100) * 6) + 2870;
			}
			if ($purposes > 960000 && $purposes < 2000000) {
				$cpurpose = (($purposes / 100) * 5.5);
			}
			if ($purposes > 2000000) {
				$purposes1 = $purposes - 2000000;
				$cpurpose  = (($purposes1 / 100) * 6.5) + 110000;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'New Home') {
				$FOG      = 10000;
				$cpurpose = 0;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG      = 0;
				$cpurpose = 0;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'Vacant Land') {
				$FOG = 10000;
			}
		}
		if ($year == WA) {
			if ($purposes <= 80000) {
				$cpurpose = ($purposes * 1.90) / 100;
			}
			if ($purposes > 80000 && $purposes < 100001) {
				$purposes1 = $purposes - 80000;
				$cpurpose  = (($purposes1 / 100) * 2.85) + 1520;
			}
			if ($purposes > 100000 && $purposes < 250001) {
				$purposes1 = $purposes - 100000;
				$cpurpose  = (($purposes1 / 100) * 3.80) + 2090;
			}
			if ($purposes > 250000 && $purposes < 500001) {
				$purposes1 = $purposes - 250000;
				$cpurpose  = (($purposes1 / 100) * 4.75) + 7790;
			}
			if ($purposes > 500000) {
				$purposes1 = $purposes - 500000;
				$cpurpose  = (($purposes1 / 100) * 5.15) + 19665;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'New Home') {
				$FOG = 10000;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG = 0;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'Vacant Land') {
				$FOG = 10000;
			}
		}
		if ($year == ACT) {
			if ($purposes <= 200000) {
				$cpurpose = ($purposes * 1.20) / 100;
			}
			if ($purposes > 200000 && $purposes < 300001) {
				$purposes1 = $purposes - 200000;
				$cpurpose  = (($purposes1 / 100) * 2.20) + 2400;
			}
			if ($purposes > 300000 && $purposes < 500001) {
				$purposes1 = $purposes - 300000;
				$cpurpose  = (($purposes1 / 100) * 3.40) + 4600;
			}
			if ($purposes > 500000 && $purposes < 750001) {
				$purposes1 = $purposes - 500000;
				$cpurpose  = (($purposes1 / 100) * 4.32) + 11400;
			}
			if ($purposes > 750000 && $purposes < 1000001) {
				$purposes1 = $purposes - 750000;
				$cpurpose  = (($purposes1 / 100) * 5.90) + 22200;
			}
			if ($purposes > 1000000 && $purposes < 1455001) {
				$purposes1 = $purposes - 1000000;
				$cpurpose  = (($purposes1 / 100) * 6.40) + 36950;
			}
			if ($purposes > 1455000) {
				$cpurpose = ($purposes / 100) * 4.54;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'New Home') {
				$FOG      = 0;
				$cpurpose = 0;
			} else {
				$FOG      = 0;
				$cpurpose = $cpurpose;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == "Established") {
				$FOG      = 0;
				$cpurpose = 0;
			}
			if ($buy1 == yes && $typ != "Investment" && $purc == 'Vacant Land') {
				$FOG      = 0;
				$cpurpose = 0;
			}
		}
		$csurcharge = round($csurcharge, 2);

		wp_send_json_success(
			array(
				'stamp_duty_state' => $year,
				'cpurpose'         => $cpurpose,
				'csurcharge'       => $csurcharge,
				'fog'              => $FOG,
				'total'            => $cpurpose + $csurcharge,
			), 
			200
		);
	}
}
