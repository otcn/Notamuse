//
// This script optically improves links by adding classes and removing http(s)
//

function classyLinks() {
  console.log('classyLinks');

  // This script adds the classes "a-extern" and "a-intern" to the designated links
  $('.answer-item p a, .overlay p a, .network-list a, .aside-info a').each(function(){
    if ( $(this).attr('href') && $(this).attr('href').match(/https?:\/\/(?!localhost)/) ) { // external links
      $(this).attr('target','_blank').addClass('a-extern').removeClass('a-intern');
    } else if ( $(this).attr('href') && $(this).attr('href').includes( 'mailto' ) ) { // mailto links
      $(this).addClass('a-extern').removeClass('a-intern');
    } else { // internal links
      $(this).attr('target','_self').removeClass('a-extern').addClass('a-intern');
    }
  });

  // This script removes "http(s)://" in front of the link in the interview aside figcaption
  $('.aside-info a').each(function(){
    var myText = $( this ).html();
    myText = myText
      .replace(/(https*\:\/\/)/g, "") // find "http://" or "https://"
      .replace(/(\/$)/g, ""); // find "slash" at end of string
    $( this ).html(myText);
  });

  // This script emphasizes the initials in front of an answer
  $( '.i-answer p, .answer-item p' ).each(function(){
    console.log('get initials');
    var myText = $( this ).html();
    myText = myText
      .replace(/([A-Z]{2}\:)/g, '<span class=\'extended\'>$1</span>'); //([A-Z]{2}\:)
    $( this ).html(myText);
  });

  // This script solves a wording conflict related to the interview place "via Email"
  $( '.aside-info li' ).each(function(){
    console.log('via Email');
    var myText = $( this ).html();
    myText = myText
      .replace(/in (via)/g, '$1');
    $( this ).html(myText);
  });

};

$( window ).on( "load", function() {

  classyLinks();

});
