
var appRouter = angular.module("aritab2c", ["ngRoute","ui.utils"]);

appRouter.directive("dayOne", function() {
  return {
    template : "<div id='dia' class='uk-card uk-padding-small uk-margin-small uk-card-default'>"
    +"<span class='days-da uk-background-primary'>Day 1</span>"
    +"<p class='uk-h4'>Arrival</p>"
    +"<div class='uk-margin'>"
    +"<label class='uk-form-label' for='form-stacked-tex't>Arrival place</label>"
    +  "<div class='uk-form-controls'>"
    +  "  <input class='uk-input' type='text' placeholder='Ex. Juan Santamaria International Airport'>"
    +  "</div>"
    +"<center><span ng-click='addNewDayTransfer(1,1);' style='margin-top: 10px;' class='uk-button uk-button-small uk-button-success addtransfer'>Add transfer on Next Day</span></center>"
    +"  </div>"
    +"</div>"
  };
});

appRouter.directive("dayfinal", function() {
  return {
    template : "<div id='dia' class='uk-card uk-padding-small uk-margin-small uk-card-default' ng-if='days.length'>"
    + "<span class='days-da uk-background-primary'>Day <span ng-if='days.length >= 1'>{{days.length+2}}</span></span>"
    +  "<p class='uk-h4'>Departure Location</p>"
    +"<center><span  ng-click='addNewDayTransfer(days.length,days.length);' style='margin-top: 10px' class='uk-button uk-button-small uk-button-success' >Add transfer on Before Day</span></center>"

    +"</div>"
  };
});

appRouter.directive("location", function() {
  return {
    template :"<div  id='locations' ng-repeat='newlocation in newlocations'>"
    +"<!-- TRANSFER 01 -->"
      +" <input ng-model='titleLocation1' hidden></input>"
        +" <input ng-model='idday'></input>"
    +" <h3 ng-if='idday != 2 '>{{newlocation.name}}</h3>"
    +"<day ></day>"
  };
});

appRouter.directive("transfer", function() {
  return {
    template :"<div id='transfer' class='uk-card uk-padding-small uk-margin-small uk-card-transfer uk-text-center'>"
    +"  <span class='days-da uk-background-primary'>Day {{day.day}}</span>"
    +"<p ><span uk-icon='icon: forward'></span> Transfer to location</p>"
    +"</div>"
  };
});

appRouter.directive("day", function(){
  return{
    template:"<div   ng-repeat='day in days' ng-if='day.locationID == newlocation.location'>"
    +"<div ng-if='day.transfer == true && newlocations.length>0'>"
    +"<transfer></transfer>"
    +"</div>"
      +" <h3 ng-if='day.day == 2'>{{titleLocation1}}</h3>"
    +  "  <!-- DIA -->"
    +"<div class='uk-card uk-padding-small uk-margin-small uk-card-default' ng-if='day.transfer != true' uk-grid>"
    +"<div class='uk-width-4-5'><span class='days-da uk-background-primary'>Day {{day.day}}</span></div><div class='uk-width-1-5 uk-text-right'> <span class='days-da2 uk-button uk-button-danger' ng-click='deleteDay(day.day,day.locationID);'><span uk-icon='icon: trash; ratio: 1;'></span></span></div>"
    +"<div class='uk-width-1-1'><a  ng-click='loadProduct(newlocation.id,day.day);'href='#modal-activities' uk-toggle class='link-product'>"
    +" <div class='uk-card uk-margin uk-text-center' style='padding: 20px; margin: 40px 0 0 0; '><span uk-icon='icon: plus-circle; ratio: 2;'></span><br><span class='uk-text-small'>Add a Product (Activity)</span></div>"
    +  " </a></div>"
    +  "</div>"
    +"  </div>"
    +  "  <p class='uk-text-center' id='addDay'><a class='uk-button uk-button-danger' ng-click='addNewDay(1,newlocation.location);'style='width:100%;'>Add New Day</a> </p>"
    +"<!-- TRANSFER 02 -->"
    +"</div>"
    +"</div>"
  }
});
