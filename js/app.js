
var appRouter = angular.module("aritab2c", ["ngRoute","ui.utils"]);


appRouter.directive("location", function() {
  return {
    template :"<hr><ul id='sortable' style='list-style: none;'><div  id='locations' ng-repeat='newlocation in newlocations'><li><span uk-icon='icon:  expand; ratio: 1;'></span>"
    +"<!-- TRANSFER 01 -->"
    +" <input ng-model='titleLocation1' hidden></input>"
    +" <h2><span uk-icon='icon: location'></span> {{newlocation.name}}</h2>"
    +"<h3><i class='fas fa-h-square'></i> {{newlocation.acomodation}}</h3>"
    +"<day></day>"
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
    /*este contenido es para transfer +"<div ng-if='day.transfer == true && newlocations.length>0'>"
    +"<transfer></transfer>"
    +"</div>"*/
    +  "  <!-- DIA -->"
    +"<div class='uk-card uk-padding-small uk-margin-small uk-card-default' ng-if='day.transfer != true' uk-grid>"
    +"<div class='uk-width-4-5'><span class='days-da uk-background-primary'>Day {{day.day}}</span></div><div class='uk-width-1-5 uk-text-right'> <span class='days-da2 uk-button uk-button-danger' ng-click='deleteDay(day.day,day.locationID);'><span uk-icon='icon: trash; ratio: 1;'></span></span></div>"
    +"<div class='uk-width-1-1'><a  ng-click='loadProduct(newlocation.id,day.day);'href='#modal-activities' uk-toggle class='link-product' ng-if='day.product == null'>"
    +" <div class='uk-card uk-margin uk-text-center' style='padding: 20px; margin: 40px 0 0 0; '><span uk-icon='icon: plus-circle; ratio: 2;'></span><br><span class='uk-text-small'>Add a Product (Activity)</span></div>"
    + " </a>"
    +" <div class='uk-card uk-margin uk-text-center uk-h2' style='padding: 20px; margin: 40px 0 0 0;background-color: #1e87f021; ' ng-if='day.product != null'>{{day.product}}"
    +  "<p class='uk-text-center''><a class='uk-button uk-button-success' ng-click='loadProduct(newlocation.id,day.day);' uk-toggle href='#modal-activities' ><span uk-icon='icon: refresh; ratio: 1;'></span></a>"
    +" <a class='uk-button uk-button-danger' ng-click='removeProduct(day.day,day.locationID);'><span uk-icon='icon: trash; ratio: 1;'></span></a></p>"
    +"</div>"
    +  "</div>"
    +  "</div>"
    +"  </div>"
    +  "  <p class='uk-text-center' id='addDay'><a class='uk-button uk-button-success' ng-click='addNewDay(1,newlocation.location,newlocation.idproduct);'style='width:100%;'><span uk-icon='icon: plus-circle; ratio: 1;'></span> Add New Day</a> </p>"
    +"<!-- TRANSFER 02 -->"
    +"</div>"
    +"</li></div></ul><hr>"
  }
});
