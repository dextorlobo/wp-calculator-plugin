<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * Class Plugin.
 *
 * @package ImArun\Calculator
 * @author  Arun Sharma <dextorlobo@gmail.com>
 * @version 1.0.0
 * @access public
 **/

namespace ImArun\Calculator;

use ImArun\Calculator\Inc\AjaxHandler;

/**
 * Class Plugin
 */
class Plugin {

	/**
	 * Construct
	 */
	public function __construct() { 
		add_action( 'init', array( $this, 'add_custom_shortcode' ), 10, 2 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_resources' ) );
		( new AjaxHandler() )->init();
	}

	/**
	 * Meethod to load resources.
	 */
	public static function load_resources() { 
		global $hook_suffix;
		wp_register_style( 'font-awesome.min.css', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css', array(), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_style( 'font-awesome.min.css' );

		wp_register_style( 'bootstrap.min.css', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css', array(), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_style( 'bootstrap.min.css' );

		wp_register_style( 'style.css', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_style( 'style.css' );

		wp_register_style( 'responsive.css', plugin_dir_url( __FILE__ ) . 'assets/css/responsive.css', array(), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_style( 'responsive.css' );

		wp_register_style( 'hover-min.css', plugin_dir_url( __FILE__ ) . 'assets/css/hover-min.css', array(), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_style( 'hover-min.css' );

		wp_register_style( 'animate.min.css', plugin_dir_url( __FILE__ ) . 'assets/css/animate.min.css', array(), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_style( 'animate.min.css' );

		wp_register_script( 'bootstrap.min.js', plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.min.js', array( 'jquery' ), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_script( 'bootstrap.min.js' );
		
		wp_register_script( 'popper.js', plugin_dir_url( __FILE__ ) . 'assets/js/popper.js', array( 'jquery' ), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_script( 'popper.js' );
		
		wp_register_script( 'wow.min.js', plugin_dir_url( __FILE__ ) . 'assets/js/wow.min.js', array( 'jquery' ), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_script( 'wow.min.js' );

		wp_register_script( 'custom.js', plugin_dir_url( __FILE__ ) . 'assets/js/custom.js', array( 'jquery' ), IMARUN_CALCULATOR_PLUGIN_VERSION );
		wp_enqueue_script( 'custom.js' );
	
		$inline_js = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		);

		wp_localize_script( 'custom.js', 'WPCalc', $inline_js );
	}

	/**
	 * Add shortcodes
	 */
	public function add_custom_shortcode() { 
		add_shortcode( 'stampduty', array( $this, 'get_stampduty_shortcode_func' ) );
		add_shortcode( 'landtax', array( $this, 'get_landtax_shortcode_func' ) );
	}

	/**
	 * Stamp duty calc.
	 */
	public function get_stampduty_shortcode_func() {
	
		$html = '<div class="dashboard">
			<div class="overlay d-none">
				<div class="overlay__inner">
					<div class="overlay__content"><span class="spinner"></span></div>
				</div>
			</div>
			<div class="main-body">
				<div class="container">
					<div class="main-content">
						<div class="main-text">
							<h3>Tax calculator</h3>
							<div class="revenue-form">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/white-house.png" alt="white-house"> State:</label>
											<select id="year" class="form-control" onchange="lets_calculate_stamp_duty();">
												<option value="NSW">NSW</option>
												<option value="NT">NT</option>
												<option value="QLD">QLD</option>
												<option value="SA">SA</option>
												<option value="TAS">TAS</option>
												<option value="VIC">VIC</option>
												<option value="WA">WA</option>
												<option value="ACT">ACT</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/value.png" alt="value"> Value of Property <span>(whole dollars):</span></label>
											<div class="input-group tp">
												<span class="input-group-addon"><span class="fa fa-usd"></span></span>
												<input type="number" id="purposes" class="form-control" min="10000" value="10000" max="100000000" onkeyup="changeRangeValue(this.value)" onchange="lets_calculate_stamp_duty();" />
												<div id="perror" style="display:none">Please fill this field.</div>
											</div>
											<div class="input-group">
												<input type="range" class="range-control" min="10000" max="100000000" id="range" name="monday" value="0" step="10000" onchange="lets_calculate_stamp_duty();" oninput="changeInputValue(this.value)" />
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/teamwork.png" alt="teamwork"> Is the owner of land a foreign person?</label>
											<div class="radio-grp">
												<div class="radio-block  rd-block1">
													<input type="radio" class="form-radio form-radio1" id="" name="foreign" value="yes" onchange="lets_calculate_stamp_duty();">
													<label for="html">Yes</label>
												</div>
												<div class="radio-block  rd-block1 active">
													<input type="radio" class="form-radio form-radio1" id="" name="foreign" value="no" onchange="lets_calculate_stamp_duty();" checked>
													<label for="css">No</label>
												</div>
											</div>
										</div>
									</div>
									<!--div class="form-group" id="mscharge" style="display:none;">
												<label class="control-label">Combined Property value of residential land for surcharge purposes <span>(whole dollars):</span></label>
												<div class="input-group">
													<span class="input-group-addon"><span class="fa fa-usd"></span></span>
													<input type="text" class="form-control" name="surcharge" id="surcharge" value="" maxlength="13" title="AUD Currency format, no dollar signs, commas, spaces or cents">
													<div id="serror" style="display:none">Please fill this field.</div>
														<div id="gerror" style="display:none">Surcharge value couldn\'t be greater than Combined taxable land value for land tax purposes</div>
												</div>
											</div-->
		
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/buyer.png" alt="buyer"> Are you first home buyer?</label>
											<div class="radio-grp">
												<div class="radio-block rd-block2">
													<input type="radio" class="form-radio form-radio2" id="" name="buyer" value="yes" onchange="lets_calculate_stamp_duty();">
													<label for="html">Yes</label>
												</div>
												<div class="radio-block rd-block2 active">
													<input type="radio" class="form-radio form-radio2" id="" name="buyer" value="no" onchange="lets_calculate_stamp_duty();" checked>
													<label for="css">No</label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/property.png" alt="property"> Property type</label>
											<div class="radio-grp">
												<div class="radio-block rd-block3">
													<input type="radio" class="form-radio form-radio3" id="" name="type" value="Primary residence" onchange="lets_calculate_stamp_duty();">
													<label for="html">Primary residence</label>
												</div>
												<div class="radio-block rd-block3 active">
													<input type="radio" class="form-radio form-radio3" id="" name="type" value="Investment" onchange="lets_calculate_stamp_duty();" checked>
													<label for="css">Investment</label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/purchase.png" alt="purchase"> Are you purchasing</label>
											<div class="radio-grp">
												<div class="radio-block rd-block4">
													<input type="radio" class="form-radio form-radio4" id="" name="purchase" onchange="lets_calculate_stamp_duty();" value="Established">
													<label for="html">Established</label>
												</div>
												<div class="radio-block rd-block4">
													<input type="radio" class="form-radio form-radio4" id="" name="purchase" onchange="lets_calculate_stamp_duty();" value="New Home">
													<label for="css">New Home</label>
												</div>
												<div class="radio-block rd-block4 active">
													<input type="radio" class="form-radio form-radio4" id="" name="purchase" onchange="lets_calculate_stamp_duty();" value="Vacant Land" checked>
													<label for="css">Vacant Land</label>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div id="txtHint">
											<div id="myModal1" class="modal-pt" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<!--div class="modal-header">
											<h4 class="modal-title">Calculation</h4>
											<button type="button" class="close" onclick="document.getElementById("myModal").style.display = "none";">&times;</button>
										</div-->
														<div class="modal-body">
															<h3>Stamp Duty</h3>
															<div class="alert alert-info" role="alert">
																<div class="TableApp">
																	<div class="row">
																		<div class="col-md-9">
																			<div class="box-content">
																				<div class="boxcontent">
																					<div class="focus">Estimated land tax payable</div>
																					<div class="focus right"><span id="stamp_cpurpose">$<?php echo $cpurpose; ?></span></div>
																				</div>
																				<div class="boxcontent">
																					<div class="focus">Estimated land tax surcharge payable</div>
																					<div class="focus right"><span id="stamp_csurcharge">$<?php echo $csurcharge; ?></span></div>
																				</div>
																				<div class="boxcontent">
																					<div class="focus">First Home Owner Grant</div>
																					<div class="focus right"><span id="stamp_fog">$<?php echo $FOG; ?></span></div>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-content">
																				<div class="boxcontent">
																					<div class="focus">Total payable</div>
																					<div class="focus right"><span id="stamp_total">$<?php echo $csurcharge + $cpurpose + $FOG; ?></span></div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<p>(If you are liable, Revenue <span id="stamp_duty_state">NSW</span> will assess you based on the appropriate Property value.)</p>
															</div>
															<p><strong>Note:</strong> All amounts are in Australian dollars. </p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';

		return $html;
	}

	/**
	 * Land tax calc.
	 */
	public function get_landtax_shortcode_func() {

		$html = '<div class="dashboard">
			<div class="overlay d-none">
				<div class="overlay__inner">
					<div class="overlay__content"><span class="spinner"></span></div>
				</div>
			</div>
			<div class="main-body">
				<div class="container">
					<div class="main-content">
						<div class="main-text">
							<div class="revenue-form">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/white-house.png" alt="white-house"> State:</label>
											<select id="year" class="form-control" onchange="lets_calculate_land_tax();">
												<option value="NSW">NSW</option>
												<option value="WA">WA</option>
												<option value="VIC">VIC</option>
												<option value="NT">NT</option>
												<option value="QLD">QLD</option>
												<option value="SA">SA</option>
												<option value="TAS">TAS</option>
												<option value="VIC">VIC</option>
												<option value="ACT">ACT</option-->
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/tax-year.png" alt="tax-year"> Tax year:</label>
											<select id="taxYear" class="form-control" name="taxYear" required="" onchange="lets_calculate_land_tax();">
												<option value="2021">2021</option>
												<option value="2020">2020</option>
												<option value="2019">2019</option>
												<option value="2018">2018</option>
												<option value="2017">2017</option>
												<option value="2016">2016</option>
											</select>
		
										</div>
									</div>
		
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/value.png" alt="value"> Value of Property <span>(whole dollars):</span></label>
											<div class="input-group tp">
												<span class="input-group-addon"><span class="fa fa-usd"></span></span>
												<input type="text" class="form-control" name="purposes" id="purposes" onchange="lets_calculate_land_tax();" value="10000" maxlength="13" title="AUD Currency format, no dollar signs, commas, spaces or cents">
												<div id="perror" style="display:none">Please fill this field.</div>
											</div>
											<div class="input-group">
												<input type="range" class="range-control" min="10000" max="100000000" id="range1" name="monday1" value="0" step="10000" onchange="lets_calculate_land_tax();" oninput="land_changeInputValue1(this.value)" />
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/property.png" alt="property"> Occupied Property <span>(Land Value of current house):</span></label>
											<div class="input-group tp">
												<span class="input-group-addon"><span class="fa fa-usd"></span></span>
												<input type="text" class="form-control" name="land_value" id="land_value" onchange="lets_calculate_land_tax();" value="" maxlength="13" title="AUD Currency format, no dollar signs, commas, spaces or cents">
												<div id="perror" style="display:none">Please fill this field.</div>
											</div>
											<div class="input-group">
												<input type="range" class="range-control" min="10000" max="100000000" id="range2" name="monday2" value="0" step="10000" onchange="lets_calculate_land_tax();" oninput="land_changeInputValue2(this.value)" />
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/teamwork.png" alt="teamwork"> Is the owner of land a foreign person?</label>
											<div class="radio-grp">
												<div class="radio-block  rd-block1">
													<input type="radio" class="form-radio form-radio1" id="" name="foreign" value="yes" onclick="land_radio(); lets_calculate_land_tax();">
													<label for="html">Yes</label><br>
												</div>
												<div class="radio-block  rd-block1 active">
													<input type="radio" class="form-radio form-radio1" id="" name="foreign" value="no" onclick="land_radio(); lets_calculate_land_tax();" checked>
													<label for="css">No</label><br>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group" id="mscharge" style="display:none;">
											<label class="control-label"><img src="'.plugin_dir_url( dirname( __FILE__ ) ).'src/assets/images/buyer.png" alt="buyer"> Combined Property value of residential land for surcharge purposes <span>(whole dollars):</span></label>
											<div class="input-group tp">
												<span class="input-group-addon"><span class="fa fa-usd"></span></span>
												<input type="text" class="form-control" name="surcharge" id="surcharge" onchange="lets_calculate_land_tax();" value="" maxlength="13" title="AUD Currency format, no dollar signs, commas, spaces or cents">
												<div id="serror" style="display:none">Please fill this field.</div>
											</div>
											<div class="input-group">
												<input type="range" class="range-control" min="10000" max="100000000" id="range" name="monday" value="0" step="10000" onchange="lets_calculate_land_tax();" oninput="land_changeInputValue(this.value)" />
											</div>
										</div>
									</div>
		
		
									<div class="col-md-12">
										<div id="txtHint">
		
											<div id="myModal12" class="modal-pt" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
		
														<div class="modal-body">
															<h3>Land Tax</h3>
															<div class="alert alert-info" role="alert">
																<div class="TableApp">
																	<div class="row">
																		<div class="col-md-9">
																			<div class="box-content">
		
																				<div class="boxcontent boxcontent1">
																					<div class="focus">Estimated land tax payable</div>
																					<div class="focus right"><span id="land_cpurpose">$<?php echo $cpurpose; ?></span></div>
																				</div>
																				<div class="boxcontent boxcontent1">
																					<div class="focus">Estimated land tax surcharge payable</div>
																					<div class="focus right"><span id="land_csurcharge">$<?php echo $csurcharge; ?></span></div>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="box-content">
																				<div class="boxcontent">
																					<div class="focus">Total payable</div>
																					<div class="focus right"><span id="land_total">$<?php echo $csurcharge + $cpurpose; ?></span></div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<p>(If you are liable, Revenue <span id="land_tax_state">NSW</span> will assess you based on the appropriate Property value.)</p>
															</div>
															<p><strong>Note:</strong> All amounts are in Australian dollars. </p>
		
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';

		return $html;
	}
}
