function ConfirmAction($text)
   {
   confirmed=confirm($text);
   if (confirmed) return true;
   else return false;
   }

function SetCookie(name,value,expires,path) {
    document.cookie = name + "=" +escape(value) +
        ( (expires) ? ";expires=" + expires.toGMTString() : "") +
        ( (path) ? ";path=" + path : "");
}