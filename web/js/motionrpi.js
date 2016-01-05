
var trtlora = (function (my) {

    var body = document.getElementsByTagName('body')[0];
    var feed = 'http://thethingsnetwork.org/api/v0/nodes/02031002/?limit=5';


    function find(id) {
        return document.getElementById(id);
    }

    function mainLoop() {

        $.getJSON(feed).then(function (sensorData) {
            var latestMotion = sensorData[0];
            var now = new Date;
            var latestTime = new Date(latestMotion.time);
            var diff = now.getTime() - latestTime.getTime() - 190;
            console.log(now, latestTime);

            diff = diff / 1000;
            render(diff);
        });
    }

    function render(diff) {
        var container = find('container');
        var motionDetected = diff < 100;

        container.innerHTML = "<h1>" + diff + "</h1>";

        if (motionDetected) {
            body.style.backgroundImage = "url('/img/vader.jpg')";
            body.style.backgroundRepeat = "no-repeat";
            return;
        }

        body.style.backgroundImage = "";
    }

    my.main = function () {
        setTimeout(mainLoop, 0);
        setInterval(mainLoop, 2000);

        setTimeout(function () {
            document.location.reload(true);
        }, 60000);
    };

    return my;
}(trtlora || {}));

trtlora.main();
