<html ng-app="mediaApp">
<head>
    <title>Media - Continued</title>
    <script src="media-data.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>
    <script type="text/javascript">
      var mediaApp = angular.module('mediaApp', []);
      
      mediaApp.controller('MediaCtrl', function ($scope) {
          $scope.tiles = mediaData;
      });

      var maxAnimDuration = 1.0; // 2 sec total animation
	  var longTermModeSecs = 120;
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
      @font-face {
          font-family: 'Humor-Sans';
          src: url('Humor-Sans.woff') format('woff'), url('Humor-Sans.ttf') format('truetype');
      }
      tile-container {
          display: block;
          width: 830px;
          margin: auto;
      }
      media-tile {
          font-family: 'Humor-Sans';
          display: block;
          width: 160px;
          height: 52px;
          text-align: center;
          float: left;
          margin: 5px 0 0 5px;
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
    <h1 class="center">These are based off this comic from XKCD.com:</h2>
    <h1  class="center">Media</h1>
    <p  class="center"><a href="https://xkcd.com/1331/">https://xkcd.com/1331/</a></p>

    <tile-container>
        <media-tile ng-repeat="tile in tiles">
            <p title="{{tile.snippet}}">{{tile.name}}</p>
        </media-tile>
    </tile-container>

    <div style="clear:both; text-align: center; margin-top: 180px; color: #aaa">
        ( This was such a great idea, I had to continue it! )<br/>
    For corrections and recommendations email Dave at <a href="mailto:dj8@joesvolcano.net" style="color: #F9922D">dj8@joesvolcano.net</a>
    </div>
</body>
</html>