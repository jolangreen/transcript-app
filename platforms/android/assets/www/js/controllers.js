angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout) {
  
  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //$scope.$on('$ionicView.enter', function(e) {
  //});
  
  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.modal.hide();
  };

  // Open the login modal
  $scope.login = function() {
    $scope.modal.show();
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {
    console.log('Doing login', $scope.loginData);

    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
})

.controller('PlaylistsCtrl', function($scope) {
  $scope.playlists = [
    { title: 'Reggae', id: 1 },
    { title: 'Chill', id: 2 },
    { title: 'Dubstep', id: 3 },
    { title: 'Indie', id: 4 },
    { title: 'Rap', id: 5 },
    { title: 'Cowbell', id: 6 }
  ];
})

.controller('PlaylistCtrl', function($scope, $stateParams) {
})

.controller('OrderController', ['$scope', '$http', '$filter', '$ionicScrollDelegate', '$anchorScroll', function($scope, $http, $filter, $ionicScrollDelegate, $anchorScroll){    

    $scope.packages = [
        {
            title: 'Standard Delivery',
            titleDescription: '',
            price: '4.30',
            priceDescription: 'per page for a first certified copy*',
            classID: 'package1'
        },
        {
            title: 'Expedite',
            titleDescription: 'Within 5 business days',
            price: '6.00',
            priceDescription: 'per page for a first certified copy*',
            classID: 'package2'
        },
        {
            title: 'Daily',
            titleDescription: 'Within 24 hours',
            price: '8.00',
            priceDescription: 'per page for a first certified copy*',
            classID: 'package3'
        }
    ];

    $scope.inputProceedingType = [
       {value: 'Criminal' },
       {value: 'YCJA*' },
       {value: 'Civil' },
       {value: 'Family' },
       {value: 'Small Claims' },
       {value: 'Justice of the Peace Intake' },
       {value: 'POA' },
       {value: 'From an Appeal Court' },
       {value: 'Other' }
    ];

    $scope.inputWhatsTranscribed = [
        {value: 'Complete Proceedings' },
        {value: 'Excerpt of Proceedings' },
        {value: 'Reasons for Judgment' },
        {value: 'Reasons for Sentence' },
        {value: 'Ruling(s)' },
        {value: 'Other' }
    ];


    $scope.inputOccupation = [
       {value: 'Legal Counsel' },
       {value: 'Accused Person or Witness' },
       {value: 'Member of the Public' },
       {value: 'Media' },
       {value: 'Federal Crown Attorney' },
       {value: 'Provincial Crown Attorney' },
       {value: 'Other' },
       {value: 'CLD Other' }
    ];


    $scope.inputProceedingDate = [
        {id: 'choice1'}
    ];

    $scope.addNewChoice = function() {
      var newItemNo = $scope.inputProceedingDate.length+1;
      $scope.inputProceedingDate.push({'id':'choice'+newItemNo});
      console.log($scope.inputProceedingDate);
    };

    

    //Date Input
      $scope.today = function() {
        $scope.dt = new Date();
      };
      $scope.today();

      $scope.clear = function () {
        $scope.dt = null;
      };

      $scope.toggleMin = function() {
        $scope.minDate = $scope.minDate ? null : new Date();
      };
      $scope.toggleMin();

      $scope.open = function($event, opened) {
          $event.preventDefault();
          $event.stopPropagation();

          $scope[opened] = true;
      };

      $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
      };

      $scope.format = 'MM/dd/yyyy';

      //$scope.date = $filter('date')($scope.inputTranscriptDate,'yyyy-MM-dd');
      //$scope.inputTranscriptDate =  new Date("2015-07-11T00:00:00");



    //*** CONTINUE BUTTON
    $scope.goNext = function(i){
        $('[href=#step'+(i+1)+']').tab('show');
        $ionicScrollDelegate.scrollTop();
        return false;
    }

    $(document).ready(function() {

      // use jQuery to update progress bar
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        var dataNumber = $(this).data("progression");
        $('.progress-bar').css({width: dataNumber + "%"});

        var href = $(e.target).attr('href');
        var $curr = $(".nav-tabs  a[href='" + href + "']").parent();

        $('.nav-tabs li').removeClass();

        $curr.addClass("active");
        $curr.prevAll().addClass("visited");

       });

    });


    


    //*** ORDER FORM SUBMISSION ***
    $scope.result = 'hidden'
    $scope.resultMessage;
    $scope.formData; //formData is an object holding the name, email, subject, and message
    $scope.submitButtonDisabled = false;
    $scope.submitted = false; //used so that form errors are shown only after the form has been submitted
    $scope.submit = function(orderform) {
        $scope.submitted = true;        
        $scope.submitButtonDisabled = true;
        //console.log($scope.formData);
        if (orderform.$valid) {
            $http({
                method  : 'POST',
                url     : 'order-form.php',
                data    : $.param($scope.formData),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                console.log(data);
                if (data.success) { //success comes from the return json object
                    $scope.submitButtonDisabled = true;
                    $scope.resultMessage = data.message;
                    $scope.result='alert alert-success';
                } else {
                    $scope.submitButtonDisabled = false;
                    $scope.resultMessage = data.message;
                    $scope.result='alert alert-danger';
                }
            });
        } else {
            $scope.submitButtonDisabled = false;
            $scope.resultMessage = 'Submit Failed - Please review each step to make sure all the form fields have been completed correctly.';
            $scope.result='alert alert-danger';
        }
    }
  

}]);
