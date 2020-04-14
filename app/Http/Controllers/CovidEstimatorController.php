<?php

namespace App\Http\Controllers;

use App\Impact;
use App\SevereImpact;
use Illuminate\Http\Request;

class CovidEstimatorController extends Controller
{
    //


function covid19ImpactEstimator(Request $data, $type='json')
{
if (!$type) {
    $tpye = 'json';
}
$input = $this->rebuildInput($data);
  $impact = $this->estimateImpact($data);
  $severeImpact = $this->estimateSevereImpact($data);
  Impact::create($impact);

  SevereImpact::create($severeImpact);
  if ($type =="json") {
    return $this->extimatorResponseJSON($input, $impact, $severeImpact);
  }
  else if($type == 'xml'){
    return $this->extimatorResponseXML($input, $impact, $severeImpact);
  }
  else{
    return $this->extimatorResponseJSON($input, $impact, $severeImpact);

  }

}


 function estimateImpact( $data)
{

   $currentlyInfected= floor($data->reportedCases *10);
   $infectionsByRequestedTime = floor($currentlyInfected * (pow(2, floor($data->timeToElapse / 3))));
   $severeCasesByRequestedTime = floor($infectionsByRequestedTime * 0.15);
   $hospitalBedsByRequestedTime = floor($severeCasesByRequestedTime - ($data->totalHospitalBeds * 0.35));
   $casesForICUByRequestedTime = floor($infectionsByRequestedTime * 0.05);
   $casesForVentilatorsByRequestedTime = floor($infectionsByRequestedTime * 0.02);
   $dollarsInFlight = floor(($infectionsByRequestedTime * $data->region['avgDailyIncomePopulation'] * $data->region['avgDailyIncomeInUSD']) / 30);
   return $impact = array(
              "currentlyInfected"=>$currentlyInfected ,
              "infectionsByRequestedTime"=> $infectionsByRequestedTime,
              "severeCasesByRequestedTime"=>$severeCasesByRequestedTime,
              "hospitalBedsByRequestedTime"=>$hospitalBedsByRequestedTime,
              "casesForICUByRequestedTime"=>$casesForICUByRequestedTime,
              "casesForVentilatorsByRequestedTime"=> $casesForVentilatorsByRequestedTime,
              "dollarsInFlight"=> $dollarsInFlight
            );

}

 function estimateSevereImpact(Request $data)
{


  $currentlyInfected= floor($data->reportedCases *50);
  $infectionsByRequestedTime = floor($currentlyInfected * (pow(2, floor($data->timeToElapse / 3))));
  $severeCasesByRequestedTime = floor($infectionsByRequestedTime * 0.15);
  $hospitalBedsByRequestedTime = floor($severeCasesByRequestedTime - ($data->totalHospitalBeds * 0.35));
  $casesForICUByRequestedTime = floor($infectionsByRequestedTime * 0.05);
  $casesForVentilatorsByRequestedTime = floor($infectionsByRequestedTime * 0.02);
  $dollarsInFlight = floor(($infectionsByRequestedTime * $data->region['avgDailyIncomePopulation'] * $data->region['avgDailyIncomeInUSD']) / 30);

 return  $severeImpact = array(
     "currentlyInfected"=>$currentlyInfected ,
     "infectionsByRequestedTime"=> $infectionsByRequestedTime,
     "severeCasesByRequestedTime"=>$severeCasesByRequestedTime,
     "hospitalBedsByRequestedTime"=>$hospitalBedsByRequestedTime,
     "casesForICUByRequestedTime"=>$casesForICUByRequestedTime,
     "casesForVentilatorsByRequestedTime"=> $casesForVentilatorsByRequestedTime,
     "dollarsInFlight"=>$dollarsInFlight

    );
}

 function extimatorResponseJSON($data, $impact, $severeImpact)
{
  return response()->json(["data"=> $data, "impact"=>$impact, "severeImpact"=>$severeImpact]);
}
function extimatorResponseXML($data, $impact, $severeImpact)
{
  return response()->xml(["data"=> $data, "impact"=>$impact, "severeImpact"=>$severeImpact]);
}

   public function rebuildInput($data)
   {
       $region = [
           'name'=>$data->region['name'],
     'avgAge'=>  $data->region['avgAge'],
     'avgDailyIncomeInUSD'=>  $data->region['avgDailyIncomeInUSD'],
    'avgDailyIncomePopulation'=>   $data->region['avgDailyIncomePopulation']
    ];

  return  $input = [
        'region'=> $region,
       'periodType'=> $data->periodType,
       'timeToElapse'=> $data->timeToElapse,
       'reportedCases'=> $data->reportedCases,
       'population'=> $data->population,
       'totalHospitalBeds'=> $data->totalHospitalBeds,

    ];

   }
}
