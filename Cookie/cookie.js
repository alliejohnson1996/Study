function add(){
  let name = "pet";
  let type = "cat";
  let expiry = new Date();
  const day = 24*3600*1000;
  expiry.setTime(expiry.getTime() + day);
  document.cookie = name + "=" + type + "; expires=" + expiry.toUTCString() + "; path=/";
}