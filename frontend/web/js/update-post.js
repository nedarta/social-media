$(document).ready(function() {
    calculate_sentences($('#post-body').val());
    $('#post-body').on('input', function(e) { calculate_sentences(e.target.value)});
});

function calculate_sentences(text) {
        let matches = text.match(/[^.?!]+?([.?!]|\s*$)/gsu);
        $('#sentence_count')[0].lastChild.data = (matches === null ? 0 : matches.length);
}