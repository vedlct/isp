//Sorting plug-in
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            //pre-processing
            "numchar-pre": function(str){
                var patt = /^([0-9]+)([a-zA-Z]+)$/;    //match data like 1a, 2b, 1ab, 100k etc.
                var matches = patt.exec($.trim(str));
                var number = parseInt(matches[2]);     //extract the number part
                var str = matches[1].toLowerCase();    //extract the "character" part and make it case-insensitive
                var dec = 0;
                for (i=0; i<str.length; i++)
                {
                    dec += (str.charCodeAt(i)-96)*Math.pow(26, -(i+1));  //deal with the character as a base-26 number
                }
                return number + dec;       //combine the two parts
            },

            //sort ascending
            "numchar-asc": function(a, b){
                return a-b;
            },

            //sort descending
            "numchar-desc": function(a, b){
                return b-a;
            }
        });

        //Automatic type detection plug-in
        jQuery.fn.dataTableExt.aTypes.unshift(
            function(sData)
            {
                var patt = /^([0-9]+)([a-zA-Z]+)$/;
                var trimmed = $.trim(sData);
                if (patt.test(trimmed))
                {
                    return 'numchar';
                }
                return null;
            }
        );