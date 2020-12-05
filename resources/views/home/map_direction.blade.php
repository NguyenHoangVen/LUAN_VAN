@extends('layouts.index')
@section('content')
<style>
/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
    height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.controls {
    margin-top: 10px;

}

#origin-input,
#destination-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    /* padding: 0 11px 0 13px; */
    text-overflow: ellipsis;
    width: 230px;
}

#origin-input:focus,
#destination-input:focus {
    border-color: #4d90fe;
}

#mode-selector {
    color: #fff;
    background-color: #4d90fe;
    margin-left: 12px;
    padding: 5px 11px 0px 11px;
}

#mode-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
}

#result_derection h5 {
    font-size: 15px;
    font-weight: bold
}

#result_derection .collapse {
    background: #e2e2f9;
    height: 500px;
    overflow: auto;
    padding: 10px
}

#result_derection .collapse p {
    margin-bottom: 15px
}

#result_derection audio {
    width: 240px;
    height: 35px;
}

.tutorial-direction {
    font-size: 20px;
    font-weight: bold;
    text-transform: uppercase;
    background: #5f5f82;
    color: white;
}
</style>
<div id="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 bg-success" style="height: 700px;padding: 0px">
                <div style="display: none">
                    <input id="origin-input" class="controls form-control" type="text"
                        placeholder="Chọn điểm xuất phát của bạn...">

                    <input id="destination-input" class="controls form-control" type="text"
                        placeholder="Chọn điểm đến của bạn...">
                </div>
                <div id="map"></div>
            </div>
            <div class="col-lg-3">
				<div class="alert tutorial-direction">Hướng dẫn đường đi</div>
				<input type="hidden" class="hoangven" value="Xin chao ban ven">
                <!-- <audio class="d-none" controls="" id="voice-audio" autoplay="" src=""></audio> -->
                <div id="result_derection">

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script>
function showListenVoice() {
    $('.myvoice').on('click', function(e) {
        var street_id = $(this).find('.street_id').val();
        $('#voice-audio-' + street_id).removeClass('d-none');
        speechFpt(street_id);
    });
}
// ==== Noi cua fpt===
function speechFpt(street_id) {

	var msg = $('#street' + street_id + ' .voice-direction').val();
	// var msg = $('.hoangven').val();
    console.log(msg);
    if (!!msg.length) {
        $.ajax({
            type: 'POST',
            url: 'https://api.fpt.ai/hmi/tts/v5',
            headers: {
                'api-key': 'ZEiUH77Um745RULASFnIlraqxqhq2l9D',
                'voice': 'banmai',
                'speed': -2
            },
            data: msg
        }).done(function(data) {
            console.log(data);
            if (data.error === 0) {
                setTimeout(() => {
                    $('#voice-audio-' + street_id).attr('src', data.async);
                }, 1000)
            } else alert(data.message)
        })
    } else {
        alert('Không nhận được dữ liệu')
    }
}
// === Noi cua javascript
function textToAudio() {
    var msg = "Hello you";

    var speech = new SpeechSynthesisUtterance();
    speech.lang = "vi-VN";

    speech.text = msg;
    speech.volume = 1;
    speech.rate = 1;
    speech.pitch = 1;

    window.speechSynthesis.speak(speech);
}

// Google map api
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        mapTypeControl: false,
        center: {
            lat: 9.986480,
            lng: 105.779736
        },
        zoom: 13
    });

    new AutocompleteDirectionsHandler(map);
}


function AutocompleteDirectionsHandler(map) {
    this.map = map;
    this.originPlaceName = null;
    this.destinationPlaceName = null;
    this.travelMode = 'DRIVING';
    this.directionsService = new google.maps.DirectionsService;
    this.directionsRenderer = new google.maps.DirectionsRenderer();
    this.directionsRenderer.setMap(map);

    // Lay cac input cua diem dau, diem cuoi, va phuong tien di chuyen
    var originInput = document.getElementById('origin-input');
    var destinationInput = document.getElementById('destination-input');
    var modeSelector = document.getElementById('mode-selector');

    // Set autocomplete cac input do
    var originAutocomplete = new google.maps.places.Autocomplete(originInput);
    var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);

    // Chi xac dinh cac truong du lieu can
    originAutocomplete.setFields(['name']);
    destinationAutocomplete.setFields(['name']);

    this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
    this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
        destinationInput);
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
}



AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
    var me = this;
    autocomplete.bindTo('bounds', this.map);

    autocomplete.addListener('place_changed', function() {

        var place = autocomplete.getPlace();

        if (!place.name) {
            window.alert('Please select an option from the dropdown list.');
            return;
        }
        // Neu mode = ORIG thi la diem xuat phat, nguoc lai la diem dich den
        if (mode === 'ORIG') {
            me.originPlaceName = place.name;
        } else {
            me.destinationPlaceName = place.name;
        }
        me.route();
    });
};

AutocompleteDirectionsHandler.prototype.route = function() {
    if (!this.originPlaceName || !this.destinationPlaceName) {
        return;
    }
    var me = this;

    this.directionsService.route({
            origin: this.originPlaceName,
            destination: this.destinationPlaceName,
            travelMode: 'DRIVING',
            provideRouteAlternatives: true
        },
        function(response, status) {
            if (status === 'OK') {

                // me.directionsRenderer.setMap(map);
                // Hien thi nhieu duong di
                var routesSteps = [];
                var routes = response.routes;
                console.log(routes)
                var colors = ['red', 'green', 'blue', 'orange', 'yellow', 'black'];
                var result = '';
                for (var i = 0; i < routes.length; i++) {

                    new google.maps.DirectionsRenderer({
                        map: me.map,
                        directions: response,
                        routeIndex: i,
                        polylineOptions: {
                            strokeColor: colors[i],
                            strokeWeight: 5,
                            strokeOpacity: .3
                        }
                    });

                    // Cac diem cua queo nga tu
                    var steps = routes[i].legs[0].steps;

                    var stepsCoords = [];
                    var voice = 'Xin chao bạn Vẹn. Mình sẽ chỉ bạn đường đi từ ' + routes[i].legs[0]
                        .start_address + ' đến' + routes[i].legs[0].end_address + ' là, đầu tiên bạn ';

                    result +=
                        '<div class="item mt-1"><div class="btn btn-info w-100" data-toggle="collapse" data-target="#street' +
                        i + '">' + routes[i].summary + '(' + routes[i].legs[0].distance.text + ')' + '</div>' +
                        '<div id="street' + i + '" class="collapse text-left">' +
                        '<button type="button" class="myvoice btn btn-primary mb-1">Listen' +
                        '<input type="hidden" class="street_id" value="' + i + '"></button>' +
                        '<audio class="d-none" controls="" id="voice-audio-' + i +
                        '" autoplay="" src=""></audio>' +
                        '<h5 class="distance">Thời gian: ' + routes[i].legs[0].duration.text + '</h5>' +
                        '<h5 class="start_address">Từ: ' + routes[i].legs[0].start_address + '</h5>' +
                        '<h5 class="end_address">Đến: ' + routes[i].legs[0].end_address + '</h5>';

                    // Danh dau cua queo

                    for (var j = 0; j < steps.length; j++) {
                        var k = j + 1;
                        // Cac chi dan bang giong noi
                        voice += steps[j].instructions + ' sau đó bạn';
                        // Cac chi dan duong di
                        result += '<p><b>' + k + '</b>.' + steps[j].instructions + '</p>';

                        // console.log(steps[j].instructions)
                        stepsCoords[j] = new google.maps.LatLng(steps[j].start_location.lat(), steps[j]
                            .start_location.lng());

                        new google.maps.Marker({
                            position: stepsCoords[j],
                            map: me.map,
                            icon: {
                                path: 'M-20,0a20,20 0 1,0 40,0a20,20 0 1,0 -40,0',
                                scale: .2,
                                fillColor: colors[i],
                                fillOpacity: .3,
                                strokeWeight: 0
                            },
                            title: steps[j].maneuver
                        });
                    }
                    routesSteps[i] = stepsCoords;
                    // Tra về kết quả đường đi và giọng nói
                    voice = voice.replace(/<[^>]+>/gm, '')
                    result += '<input type="hidden" class="voice-direction" value="' + voice + '">';
                    result += '</div></div>';
                }

                $('#result_derection').html(result)
                showListenVoice();
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
};
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAooDY7d6iFESb-veaQGNNeSVrb_isnJUI&libraries=places&callback=initMap"
    defer></script>
@endsection