<?php

function wpbt_coba_register_form()
{
    ?>

        <?php if( errors_has("register_error_url") ): ?>
            <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $_SESSION["errors"]["register_error_url"] ?>
            </div>
        <?php endif; ?>

        <section style="background-color: rgba(0,0,0,0.5);background-image: url('<?php echo network_site_url( '/wp-content/uploads/2022/08/sean-oulashin-KMn4VEeEPR8-unsplash-300x199.jpg' ) ?>');background-position: center center;background-repeat: no-repeat;background-blend-mode: darken;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;padding: 8rem 10rem;">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <h1 class="title-heading-left" style="margin:0;color:#ffffff;line-height:30px;"><strong>Welcome,</strong><br><span style="font-size: 25px;">Sign up now</span></h1>
                    </div>
                    <div class="">
                        <p style="text-align: left;color:#ffffff;">Lorem ipsum lorem ipsum Lorem ipsum lorem ipsum Lorem ipsum lorem ipsum</p>
                    </div>
                </div>
                <div class="col-md-6">

                    <form action="<?php echo get_admin_url() ?>admin-post.php" class="form-horizontal" method="post" enctype="multipart/form-data" style="gap: 10px;display: flex;flex-direction: column;">
            
                        <input type="hidden" name="auth_nonce" value="<?php echo wp_create_nonce( get_template_directory_uri( __FILE__ ) ) ?>" />
                        <input type='hidden' name='action' value='submit_form_register2' />
            
                        <div class="<?php echo "form-group" . ( errors_has("company_name") ? " has-error" : "" );  ?>">
                            <input type="text" class="form-control form_bt_input" name="company_name" placeholder="Company Name" value="<?php old("username") ?>">
                            <?php if( errors_has("company_name") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["company_name"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="<?php echo "form-group" . ( errors_has("company_country") ? " has-error" : "" );  ?>">
                            
							<select name="company_country" id="company_country" class="form_bt_input_select">
								<option value="" disabled="" selected="">Please select choose country</option>
								<option value="Afghanistan, Islamic Emirate of">Afghanistan, Islamic Emirate of</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">AndorrA</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antarctica">Antarctica</option>
								<option value="Antigua and Barbuda">Antigua and Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Bouvet Island">Bouvet Island</option>
								<option value="Brazil">Brazil</option>
								<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
								<option value="Brunei Darussalam">Brunei Darussalam</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Chile">Chile</option>
								<option value="People's Republic of Tiongkok">People's Republic of Tiongkok</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Côte d'Ivoire">Côte d'Ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands (Islas Malvinas)">Falkland Islands (Islas Malvinas)</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guernsey">Guernsey</option>
								<option value="Guinea">Guinea</option>
								<option value="Guinea-Bissau">Guinea-Bissau</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
								<option value="Vatican City">Vatican City</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong, Province of China">Hong Kong, Province of China</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Islamic Republic of Iran">Islamic Republic of Iran</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Zionist Israel">Zionist Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jersey">Jersey</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="North Korea, Democratic People's Republic of Korea">North Korea, Democratic People's Republic of Korea</option>
								<option value="South Korea, Republic of Korea">South Korea, Republic of Korea</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Laos, Lao People'S Democratic Republic">Laos, Lao People'S Democratic Republic</option>
								<option value="Åland Islands">Åland Islands</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libya">Libya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macao">Macao</option>
								<option value="North Macedonia">North Macedonia</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malawi">Malawi</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Micronesia">Micronesia</option>
								<option value="Moldova">Moldova</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montenegro">Montenegro</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Namibia">Namibia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherlands">Netherlands</option>
								<option value="Netherlands Antilles">Netherlands Antilles</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Northern Mariana Islands">Northern Mariana Islands</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau">Palau</option>
								<option value="Palestine,">Palestine</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Philippines">Philippines</option>
								<option value="Pitcairn Islands">Pitcairn Islands</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russian Federation">Russian Federation</option>
								<option value="Rwanda">Rwanda</option>
								<option value="Saint Helena">Saint Helena</option>
								<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
								<option value="Saint Lucia">Saint Lucia</option>
								<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
								<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
								<option value="Samoa">Samoa</option>
								<option value="San Marino">San Marino</option>
								<option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">  Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
								<option value="Eswatini">Eswatini</option>
								<option value="Sweden" sweden<="" option="">
								</option><option value="Switzerland">Switzerland</option>
								<option value="Syrian Arab Republic">Syrian Arab Republic</option>
								<option value="Taiwan, Province of China">Taiwan, Province of China</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="United Republic of Tanzania">United Republic of Tanzania</option>
								<option value="Thailand">Thailand</option>
								<option value="Timor-Leste">Timor-Leste</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad and Tobago">Trinidad and Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkiye">Turkiye</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Emirates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States">United States</option>
								<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
								<option value="Uruguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Viet Nam">Viet Nam</option>
								<option value="British Virgin Islands">British Virgin Islands</option>
								<option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
								<option value="Wallis and Futuna">Wallis and Futuna</option>
								<option value="Western Sahara">Western Sahara</option>
								<option value="Yemen">Yemen</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
							</select>
                            <!-- <input type="text" class="form-control form_bt_input" name="company_country" placeholder="Company Name" value="<?php old("username") ?>"> -->
                            <?php if( errors_has("company_country") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["company_country"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="<?php echo "form-group" . ( errors_has("username") ? " has-error" : "" );  ?>">
                            <input type="text" class="form-control form_bt_input" name="username" placeholder="Username" value="<?php old("username") ?>">
                            <?php if( errors_has("username") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["username"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="<?php echo "form-group" . ( errors_has("email") ? " has-error" : "" );  ?>">
                            <input type="text" class="form-control form_bt_input" name="email" placeholder="Email" value="<?php old("email") ?>">
                            <?php if( errors_has("email") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["email"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="<?php echo "form-group" . ( errors_has("password") ? " has-error" : "" );  ?>">
                            <input type="password" class="form-control form_bt_input" id="password-register" name="password" placeholder="Password">
                            <?php if( errors_has("password") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["password"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="<?php echo "form-group" . ( errors_has("password_confirm") ? " has-error" : "" );  ?>">
                            <input type="password" class="form-control form_bt_input" name="password_confirm" placeholder="Confirm Password">
                            <?php if( errors_has("password_confirm") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["password_confirm"]; ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
            
                        <div class="form-group" style="margin-top:16px;">
                            <button type="submit" class="btn_bt register">
                                Sign Up
                            </button>
                            <p class="bt_or" style="">OR</p>
                            <a href="<?php echo network_site_url( '/login-member' ) ?>" class="btn_bt_link">
                                Log In
                            </a>
                        </div>
            
                    </form>

                </div>
            </div>
        </section>
        <style>
            html.avada-is-100-percent-template #main {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            input[type=text].form_bt_input,
            input[type=password].form_bt_input,
            input[type=email].form_bt_input,
            input[type=text].form_bt_input {
                background: transparent;
                border-top: 0px;
                border-left: 0px;
                border-right: 0px;
                border-radius: 0px;
                color: #fff;
                opacity: 1;
            }
            input.form_bt_input::-webkit-input-placeholder {
                color: #fff;
            }
            input.form_bt_input:-internal-autofill-selected {
                background: transparent !important;
            }
            input.form_bt_input:-webkit-autofill, 
            textarea.form_bt_input_textarea:-webkit-autofill, 
            select.form_bt_input_select:-webkit-autofill { 
                background-color: transparent !important;
                -webkit-box-shadow: 0 0 0px 0px #ffffff00 inset;
            }
            .btn_bt {
                width: 100%;
                height: 40px;
                border: 0px;
                border-radius: 5px;
                cursor: pointer;
                background: #fff;
                font-size: 15px;
            }
            .btn_bt:hover {
                background: #1f3163;
                color: #fff;
            }
            .btn_bt_link {
                font-size: 15px;
                color: #fff;
                width: 100%;
                line-height: 40px;
                text-align: center;
                display: block;
            }
            .btn_bt_link:hover {
                background: #66a7db;
                color: #000;
                border-radius: 5px;
            }

            .bt_or {
                display: block;
                text-align: center;
                margin: 15px 0px !important;
                color: #fff;
                font-size: 14px;
            }
            .bt_or:before,
            .bt_or:after {
            background-color: #fff;
            content: "";
            display: inline-block;
            height: 1px;
            position: relative;
            vertical-align: middle;
            width: 40%;
            }
            .bt_or:before {
            right: 1em;
            margin-left: -50%;
            }
            .bt_or:after {
            left: 1em;
            margin-right: -50%;
            }
            .form_bt_input_select {
                width: 100%;
                background: transparent;
                box-shadow: none;
                border-top: 0px;
                border-left: 0px;
                border-right: 0px;
                --webkit-border-radius: 0px;
                border-radius: 0px;
                --webkit-box-shadow: none;
                -webkit-appearance: none;
                color: #fff;
                padding: 0px 15px;
            }
        </style>
    <?php
}
?>