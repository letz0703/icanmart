<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="kr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<div id="root">
    <input type="text" id="input" v-model="message">
    <p> Message is : @{{ message }}</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script>
    let data = { message: 'hello' };
    new Vue({
        el: '#root',
        data: data
    });
</script>
</body>
</html>
