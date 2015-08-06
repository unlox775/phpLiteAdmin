<html>
<head>
    <script src="mc-data.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular.min.js"></script>
    <script type="text/javascript">
      var mediaApp = angular.module('mediaApp', []);
      
      mediaApp.controller('MediaCtrl', function ($scope) {
          $scope.tiles = mediaData;
      });

      mediaApp.directive('mediaTile', function() {
          return {
              link: function ($scope,element) {

                  var totalAnimDuration = ( $scope.tile.interval / 2 ) > maxAnimDuration ? maxAnimDuration : ( $scope.tile.interval / 2 );
				  //  Fade instantly to gray
                  $(element).find('p').fadeTo( 0, 0.30);

				  // Blink
                  var tileBlink = function() {
                      $(element).find('p').fadeTo(     totalAnimDuration * .05 * 1000, 1.00, function(){
                          $(element).find('p').fadeTo( totalAnimDuration * .95 * 1000, 0.30);
                      });
                  };
				  
                  // Short term
                  if ( $scope.tile.interval < longTermModeSecs ) {
                      var intervalMs = $scope.tile.interval * 1000;
//                      console.log($scope.tile.name +' every '+ r1(intervalMs) +' miiliseconds');
                      setInterval(tileBlink, intervalMs);
                  }

				  // Long term (only accurate to 1 sec)
				  else {
					  var nextBlink = new Date().getTime() + ($scope.tile.interval * 1000);
                      setInterval(function () {
//						  console.log($scope.tile.name +': '+ ((nextBlink - new Date().getTime()) / 1000 ) +' sec left');
						  if ( new Date().getTime() > nextBlink ) {
//							  console.log($scope.tile.name +': BLINK!');
							  nextBlink = new Date().getTime() + ($scope.tile.interval * 1000);
							  tileBlink();
						  }
					  }, 1000);
				  }
              },
              restrict: 'E'
          }
      });
      
    </script>
    <style type="text/css">
      body {
		  background-color: black;
		  color: white
      }
      tile-container {
          display: block;
          width: 830px;
          margin: auto;
      }
      media-tile {
          display: block;
          width: 160px;
          height: 52px;
          text-align: center;
          float: left;
          margin: 5px 0 0 5px;
      }
	  media-tile .poster-image {
		  display: block;
		  margin: 10px;
		  width: 150px;
		  height: 150px;
		  color: transparent;
		  background-image: url("http://farm8.staticflickr.com/7356/9101542931_957d6d639e_q.jpg");
		  -webkit-box-reflect: below 0 -webkit-gradient(linear, left bottom, left top, from(rgba(255,255,255,0.25)), color-stop(0.9, transparent));
	  }
      .center {
          text-align: center;
      }
      h1 {
          font-variant: small-caps;
          font-family: Lucida,Helvetica,sans-serif;
          font-size: 21px;
          font-weight: 800;
      }
    </style>
</head>
<body  ng-controller="MediaCtrl">
    <h1  class="center">Media</h1>

    <tile-container>
        <media-tile ng-repeat="tile in tiles">
			<span class="poster-image" style="background-image: url({{tile.data.posters.profile}})"/>
            <p title="{{tile.snippet}}">{{tile.name}}</p>
        </media-tile>
    </tile-container>
</body>
</html>