<?php


    add_action( 'wp_enqueue_scripts', 'plugin_admin_init' );
    function plugin_admin_init(){
        wp_enqueue_style( 'bootstrap-plugin', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
        wp_enqueue_style( 'customstyle-plugin', plugins_url( '../assets/css/style.css', __FILE__ ));
    }

    add_shortcode('mortgage-calculator', 'mortgage_calculator');

	function mortgage_calculator($attr, $content){
		ob_start();
            if( isset( $_POST['calculate'] ) ){


                $ShowDebugInfo          = isset( $_POST['ShowDebugInfo'] ) ? $_POST['ShowDebugInfo'] : 'false';
                $NumberOfInsuredPersons = isset( $_POST['NumberOfInsuredPersons'] ) ? $_POST['NumberOfInsuredPersons'] : '1';
                $Ip1Name                = isset( $_POST['Ip1Name'] ) ? $_POST['Ip1Name'] : '';
                $Ip1Surname             = isset( $_POST['Ip1Surname'] ) ? $_POST['Ip1Surname'] : '';
                $Ip1BirthDate           = isset( $_POST['Ip1BirthDate'] ) ? $_POST['Ip1BirthDate'] : '';
                $Ip1BirthDate           = date("Y-m-d", strtotime($Ip1BirthDate));
                $Ip1IsSmoker            = isset( $_POST['Ip1IsSmoker'] ) ? $_POST['Ip1IsSmoker'] : 'SMOKER';
                $Ip1Gender              = isset( $_POST['Ip1Gender'] ) ? $_POST['Ip1Gender'] : '';
                $Fiscality              = isset( $_POST['Fiscality'] ) ? $_POST['Fiscality'] : '';
                $PurposeType            = isset( $_POST['PurposeType'] ) ? $_POST['PurposeType'] : '';
                $FreeCoverageStartDate  = isset( $_POST['FreeCoverageStartDate'] ) ? $_POST['FreeCoverageStartDate'] : '';
                $FreeCoverageStartDate  = date("Y-m-d", strtotime($FreeCoverageStartDate));
                $StartDate              = isset( $_POST['StartDate'] ) ? $_POST['StartDate'] : '';
                $StartDate              = date("Y-m-d", strtotime($StartDate));
                $Formula = isset( $_POST['Formula'] ) ? $_POST['Formula'] : '';
                $AmortizationFrequency = isset( $_POST['AmortizationFrequency'] ) ? $_POST['AmortizationFrequency'] : '';
                $InsuredAmount = isset( $_POST['InsuredAmount'] ) ? $_POST['InsuredAmount'] : 'false';
                $YearlyInterestPercentage = isset( $_POST['YearlyInterestPercentage'] ) ? $_POST['YearlyInterestPercentage'] : '';
                $CoverageDurationInMonths = isset( $_POST['CoverageDurationInMonths'] ) ? $_POST['CoverageDurationInMonths'] : '';
                $MonthsWithoutAmortization = isset( $_POST['MonthsWithoutAmortization'] ) ? $_POST['MonthsWithoutAmortization'] : '';
                $DurationType = isset( $_POST['DurationType'] ) ? $_POST['DurationType'] : '';
                $CommissionPercentage = isset( $_POST['CommissionPercentage'] ) ? $_POST['CommissionPercentage'] : '';
                $CommissionFixedAmount = isset( $_POST['CommissionFixedAmount'] ) ? $_POST['CommissionFixedAmount'] : '';
                $PremiumType = isset( $_POST['PremiumType'] ) ? $_POST['PremiumType'] : '';
                $PaymentFormula = isset( $_POST['PaymentFormula'] ) ? $_POST['PaymentFormula'] : '';
                $PaymentFrequencyFirstYear = isset( $_POST['PaymentFrequencyFirstYear'] ) ? $_POST['PaymentFrequencyFirstYear'] : '';
                $PaymentFrequency = isset( $_POST['PaymentFrequency'] ) ? $_POST['PaymentFrequency'] : '';
                $TariffCode = isset( $_POST['TariffCode'] ) ? $_POST['TariffCode'] : '';
        
        
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://my.aviza.be/auth/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'username=niessen.erwin@dhsgroup.be&password=C6eX*wre7WeJa3ep&grant_type=password&client_id=xxx',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: text/plain'
                ),
                ));
        
                $response = curl_exec($curl);
        
                curl_close($curl);
        
                $token = json_decode( $response, true )['access_token'];
        
        
        
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://my.aviza.be/api/I/External/PremiumCalculation',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{"ShowDebugInfo":'.$ShowDebugInfo.',"NumberOfInsuredPersons":'.$NumberOfInsuredPersons.',"Ip1Name":"'.$Ip1Name.'","Ip1Surname" :"'.$Ip1Surname.'","Ip1BirthDate":"'.$Ip1BirthDate.'T00:00:00","Ip1IsSmoker":"'.$Ip1IsSmoker.'","Ip1Gender":"'.$Ip1Gender.'","Fiscality":"'.$Fiscality.'","PurposeType":"'.$PurposeType.'","FreeCoverageStartDate":"'.$FreeCoverageStartDate.'T00:00:00","StartDate":"'.$StartDate.'T00:00:00","Formula":"'.$Formula.'","AmortizationFrequency":"'.$AmortizationFrequency.'","InsuredAmount":'.$InsuredAmount.',"YearlyInterestPercentage":'.$YearlyInterestPercentage.',"CoverageDurationInMonths":'.$CoverageDurationInMonths.',"MonthsWithoutAmortization":'.$MonthsWithoutAmortization.',"DurationType":"'.$DurationType.'","CommissionPercentage":'.$CommissionPercentage.',"CommissionFixedAmount":'.$CommissionFixedAmount.',"PremiumType":"'.$PremiumType.'","PaymentFormula":"'.$PaymentFormula.'","PaymentFrequencyFirstYear":"'.$PaymentFrequencyFirstYear.'","PaymentFrequency":"'.$PaymentFrequency.'","TariffCode":"'.$TariffCode.'"}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
                ));
        
                $response = curl_exec($curl);
        
                curl_close($curl);
        
                // echo "<pre>";
                // echo print_r( json_decode( $response, true )['messages'] );
                // echo "</pre>";
        
                $premiums = isset(json_decode( $response, true )['premiums']) ? json_decode( $response, true )['premiums'] : array();
                $messages = isset(json_decode( $response, true )['messages']) ? json_decode( $response, true )['messages'] : array();
        
            }

            if( isset( $_POST['calculate'] ) ) : ?>

            <div class="container mt-5 ">
                <h2 class="text-center mb-2">Calculation Result</h2>
                <div class="row my-5">
                <?php if(count($premiums) > 0) : ?>
                    <div class="col">
                        <ul class="list-group">

                            <?php foreach( $premiums as $premium ) : ?>

                                <?php if(isset($premium)) : foreach( $premium as $key => $single ) : ?>

                                    <?php if(isset($single) && $key != '$type') : ?>
                                    <li class="list-group-item"><?php echo '<span class="key-title">'.strtoupper($key) .' </span>: '.$single; ?></li>
                                    <?php endif; ?>

                                <?php endforeach; endif; ?>

                            <?php endforeach; ?>
                            

                        </ul>
                    </div>
                    <div class="col">
                        <?php foreach( $messages as $message ) : ?>
                        <div class="alert alert-<?php echo strtolower($message['messageLevel']); ?>">
                            <?php echo $message['messageContent']; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php else : ?>
                        <h6 class="text-center">Sorry, No Result Matched!</h6>
                    <?php endif; ?>

                </div>
            </div>

            <?php endif; ?>
            
            <div class="container my-3">
                <h2 class="text-center mb-4">Mortgage Calculator</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" role="form" class="form-horizontal">
                            <div class="form-group my-3">
                                <input type="checkbox" id="ShowDebugInfo" name="ShowDebugInfo" value="true" checked>
                                <label for="ShowDebugInfo" class="my-1 col-sm-2 control-label">Show Debug Info<span class="required">*</span></label>
                            </div>

                            <div class="form-group my-3">
                                <label for="NumberOfInsuredPersons" class="my-1 col-sm-2 control-label">Number Of Insured Persons<span class="required">*</span></label>
                                <input type="number" id="NumberOfInsuredPersons" min="1" max="2140000000" name="NumberOfInsuredPersons" value="1" class="form-control" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="Ip1Name" class="my-1 col-sm-2 control-label">Name<span class="required">*</span></label>
                                <input required type="text" id="Ip1Name" name="Ip1Name" class="form-control" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="Ip1Surname" class="my-1 col-sm-2 control-label">Surname<span class="required">*</span></label>
                                <input required type="text" id="Ip1Surname" name="Ip1Surname" class="form-control" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="Ip1BirthDate" class="my-1 col-sm-2 control-label">Birth Date<span class="required">*</span></label>
                                <input required type="date" id="Ip1BirthDate" name="Ip1BirthDate" class="form-control" max="1984-10-30" min="1964-04-01" value="1984-10-02" required>
                            </div>
                            <div class="form-group my-3">
                                <label for="Ip1IsSmoker" class="my-1 col-sm-2 control-label">Is Smoker<span class="required">*</span></label>
                                <select name="Ip1IsSmoker" class="form-control" required>
                                    <option value="">--select--</option>
                                    <option value="SMOKER" selected>Smoker</option>
                                </select>
                            </div>

                            <div class="form-group my-3">
                                <label for="Ip1Gender" class="my-1 col-sm-2 control-label">Gender<span class="required">*</span></label>
                                <select name="Ip1Gender" class="form-control" required>
                                    <option value="">--select--</option>
                                    <option value="MALE" selected>Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>

                            <div class="form-group my-3">
                                <label for="Fiscality" class="my-1 col-sm-2 control-label">Fiscality<span class="required">*</span></label>
                                <select name="Fiscality" class="form-control" required>
                                    <option value="">--select--</option>
                                    <option value="NP_NOT_FISCAL" selected>NP NOT FISCAL</option>
                                </select>
                            </div>

                            <div class="form-group my-3">
                                <label for="PurposeType" class="my-1 col-sm-2 control-label">Purpose Type<span class="required">*</span></label>
                                <select name="PurposeType" class="form-control" required>
                                    <option value="">--select--</option>
                                    <option value="MORTGAGE_LOAN" selected>Mortgage Loan</option>
                                </select>
                            </div>

                            
                            <div class="form-group my-3">
                                <label for="FreeCoverageStartDate" class="my-1 col-sm-2 control-label">Free Coverage Start Date<span class="required">*</span></label>
                                <input type="date" value="2022-10-10" id="FreeCoverageStartDate" name="FreeCoverageStartDate" class="form-control" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="StartDate" class="my-1 col-sm-2 control-label">Start Date<span class="required">*</span></label>
                                <input type="date" value="2022-10-10" id="StartDate" name="StartDate" class="form-control" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="Formula" class="my-1 col-sm-2 control-label">Formula<span class="required">*</span></label>
                                <select name="Formula" class="form-control" required>
                                    <option value="">--select--</option>
                                    <option value="ANNUITY" selected>Annuity</option>
                                </select>
                            </div>

                            <div class="form-group my-3">
                                <label for="AmortizationFrequency" class="my-1 col-sm-2 control-label">Amortization Frequency<span class="required">*</span></label>
                                <select name="AmortizationFrequency" class="form-control" required>
                                    <option value="">--select--</option>
                                    <option value="MONTHLY" selected>Monthly</option>
                                </select>
                            </div>

                            <div class="form-group my-3">
                                <label for="InsuredAmount" class="my-1 col-sm-2 control-label">Insured Amount<span class="required">*</span></label>
                                <input min="88850" max="20000000" type="number" id="InsuredAmount" name="InsuredAmount" class="form-control" value="150000.0" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="YearlyInterestPercentage" class="my-1 col-sm-2 control-label">Yearly Interest Percentage<span class="required">*</span></label>
                                <input type="number" min="2.05" max="20.00"  value="2.05" id="YearlyInterestPercentage" name="YearlyInterestPercentage" class="form-control" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="CoverageDurationInMonths" class="my-1 col-sm-2 control-label">Coverage Duration In Months<span class="required">*</span></label>
                                <input type="number" min="152" max="440"  value="240" id="CoverageDurationInMonths" name="CoverageDurationInMonths" class="form-control" required>
                            </div>
                            

                            <div class="form-group my-3">
                                <label for="MonthsWithoutAmortization" class="my-1 col-sm-2 control-label">Months Without Amortization<span class="required">*</span></label>
                                <input type="number" value="0" id="MonthsWithoutAmortization" name="MonthsWithoutAmortization" class="form-control" required>
                            </div>
                            

                            <div class="form-group my-3">
                                <label for="DurationType" class="my-1 col-sm-2 control-label">Duration Type<span class="required">*</span></label>
                                <select name="DurationType" class="form-control" id="DurationType" required>
                                    <option value="">--select--</option>
                                    <option value="TWO_THIRDS_DURATION" selected>TWO THIRDS DURATION</option>
                                </select>
                            </div>
                            
                            <div class="form-group my-3">
                                <label for="CommissionPercentage" class="my-1 col-sm-2 control-label">Commission Percentage<span class="required">*</span></label>
                                <input type="number" value="10" id="CommissionPercentage" name="CommissionPercentage" class="form-control" required>
                            </div>
                            
                            <div class="form-group my-3">
                                <label for="CommissionFixedAmount" class="my-1 col-sm-2 control-label">Commission Fixed Amount<span class="required">*</span></label>
                                <input type="number" value="0.0" id="CommissionFixedAmount" name="CommissionFixedAmount" class="form-control" required>
                            </div>
                            
                            <div class="form-group my-3">
                                <label for="PremiumType" class="my-1 col-sm-2 control-label">Premium Type<span class="required">*</span></label>
                                <select name="PremiumType" class="form-control" id="PremiumType" required>
                                    <option value="">--select--</option>
                                    <option value="CONSTANT_PREMIUMS" selected>Constant Premiums</option>
                                </select>
                            </div>
                            
                            <div class="form-group my-3">
                                <label for="PaymentFormula" class="my-1 col-sm-2 control-label">Payment Formula<span class="required">*</span></label>
                                <select name="PaymentFormula" class="form-control" id="PaymentFormula" required>
                                    <option value="">--select--</option>
                                    <option value="HS_12_13_INSURANCE_DURATION" selected>HS 12 13 INSURANCE DURATION</option>
                                </select>
                            </div>
                            
                            <div class="form-group my-3">
                                <label for="PaymentFrequencyFirstYear" class="my-1 col-sm-2 control-label">Payment Frequency First Year<span class="required">*</span></label>
                                <select name="PaymentFrequencyFirstYear" class="form-control" id="PaymentFrequencyFirstYear" required>
                                    <option value="">--select--</option>
                                    <option value="MONTHLY" selected>Monthly</option>
                                </select>
                            </div>
                            
                            <div class="form-group my-3">
                                <label for="PaymentFrequency" class="my-1 col-sm-2 control-label">Payment Frequency<span class="required">*</span></label>
                                <select name="PaymentFrequency" class="form-control" id="PaymentFrequency" required>
                                    <option value="">--select--</option>
                                    <option value="MONTHLY" selected>Monthly</option>
                                </select>
                            </div>
                            
                            <div class="form-group my-3">
                                <label for="TariffCode" class="my-1 col-sm-2 control-label">Tariff Code<span class="required">*</span></label>
                                <input type="text" id="TariffCode" name="TariffCode" class="form-control" value="EA11" required>
                            </div>
                            
                            <div class="form-group my-3">
                                <input type="submit" name="calculate" class="btn btn-primary btn-lg" value="Calculate">
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <?php return ob_get_clean();
	}
