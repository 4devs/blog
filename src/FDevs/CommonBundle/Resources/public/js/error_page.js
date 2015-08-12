$(document).ready(function() {
    $('#scene').parallax({
        calibrateX: false,
        calibrateY: false,
        invertX: true,
        invertY: true,
        limitX: false,
        limitY: false,
        scalarX: 5,
        scalarY: 4,
        frictionX: 0.3,
        frictionY: 0.6
    });
});
