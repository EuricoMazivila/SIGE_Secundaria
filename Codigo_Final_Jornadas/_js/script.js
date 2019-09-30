$(document).ready(function() {
    $(".my-progress-bar").circularProgress({
        line_width: 8,
        color: "green",
        starting_position: 0, // 12.00 o' clock position, 25 stands for 3.00 o'clock (clock-wise)
        percent: 0, // percent starts from
        percentage: true,
        height: "200px",
        width: "150px",
    }).circularProgress('animate', 100, 1000);
});
