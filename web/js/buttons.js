/**
 * Created by artur on 29.11.16.
 */

var state = 0,
    states = {
        0: {0: 1, 1: 2, 2: 3},
        1: {0: 2, 1: 3, 2: 1},
        2: {0: 3, 1: 1, 2: 2},
    };

$(document).on('click', ".button", function(){
    state += 1;

    if(state > 2){
        state = 0;
    }

    reDraw(state);
});

function reDraw(stateId){
   $(".buttons").replaceWith(getTemplate(states[stateId]));
}

function getTemplate(state){
   return '<div class="buttons">' +
       '<div><button class="button" type="button">' + state[0] + '</button></div>' +
       '<div><button class="button" type="button">' + state[1] + '</button></div>' +
       '<div><button class="button" type="button">' + state[2] + '</button></div>' +
       '</div>';
}
