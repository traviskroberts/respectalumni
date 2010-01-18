
var num_of_quotes = 10;
quotes = Math.floor (num_of_quotes * Math.random());
var author;
var body;

if (quotes==0) {

author="Jon Elders";
body="\"To all the guys who couldn't be here, and all the girls who wished they were.\"";
}

if (quotes==1) {
author="Chris Gilbert";
body="\"Oh man, was that a milf or just a hot girl?\"";
}

if (quotes==2) {
author="John Boren";
body="\"Someone needs to tell that !@&%* how to respect alumni.\"";
}

if (quotes==3) {
author="James Alkire";
body="\"The best I'll ever be able to say for my degree is, 'Hey, I did it!  I'm a good person now!'\"";
}

if (quotes==4) {
author="Ross O'Keefe";
body="\"Well, I can imagine we'll be doing a lot of drinking.\"";
}

if (quotes==5) {
author="Jonathan Kilgore";
body="(Kilgore on graduation): \"You gonna graduate, man?\"<br />\"We'll see.  Coin toss.\"";
}

if (quotes==6) {
author="Robb Huffman";
body="\"There's nothing better than liquor on another man's dime.\"";
}

if (quotes==7) {
author="Nathan Bush";
body="\"Our fraternity is the exact opposite of everything else out there.\"";
}

if (quotes==8) {
author="Travis Roberts";
body="\"Never has there been a finer group of human beings assembled before God or man.\"";
}

if (quotes==9) {
author="Josh Reeves";
body="\"The only dues we pay is admitting that we know James Alkire.\"";
}

if (quotes==9) {
author="Trey Wood";
body="\"Don't let ambition get in the way of being lazy.\"";
}


document.write('<p>'+ body +'<br />');
document.write('-' + author + '</p>');