
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
    +"  </div>"
    +"</div>"
  };
});

appRouter.directive("location", function() {
  return {
    template :"<div  id='locations' ng-repeat='newlocation in newlocations'>"
    +"<!-- TRANSFER 01 -->"

    +"<day ></day>"
  };
});

appRouter.directive("day", function(){
  return{
    template:"<div   ng-repeat='day in days' ng-if='day.locationID == newlocation.location'>"
    +"<div ng-if='day.transfer == true'>"
    +"<div id='transfer' class='uk-card uk-padding-small uk-margin-small uk-card-transfer uk-text-center'>"
    +"  <span class='days-da uk-background-primary'>Day {{day.day}}</span>"
    +"<p ><span uk-icon='icon: forward'></span> Transfer to first location</p>"
    +"</div>"
      +" <h3 >location #{{newlocation.location}}</h3>"
      +"</div>"
    +  "  <!-- DIA -->"
    +"<div class='uk-card uk-padding-small uk-margin-small uk-card-default' ng-if='day.transfer != true'>"
    +"<span class='days-da uk-background-primary'>Day {{day.day}}</span>"
    +"<a href='#modal-activities' uk-toggle class='link-product'>"
    +" <div class='uk-card uk-margin uk-text-center' style='padding: 20px; margin: 40px 0 0 0; '><span uk-icon='icon: plus-circle; ratio: 2;'></span><br><span class='uk-text-small'>Add a Product (Activity)</span></div>"
    +  " </a>"
    +  "</div>"
    +"  </div>"
    +  "  <p class='uk-text-center' id='addDay'><a class='uk-button uk-button-danger' ng-click='addNewDay(1,newlocation.location);'style='width:100%;'>Add New Day</a> </p>"
    +"<!-- TRANSFER 02 -->"
    +"</div>"
    +"</div>"
  }
})
