        //为了兼容ie的设置
        function getXhr() {
            var xmlhtttp;
            if (window.XMLHttpRequest) {
                
                xmlhttp = new XMLHttpRequest()
            } else {
                xmlhttp = new ActiveXObject('Msxm12.XMLHTTP')
            }
            return xmlhttp;
        }
