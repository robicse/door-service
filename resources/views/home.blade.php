<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-translate-customization" content="e6d13f48b4352bb5-f08d3373b31c17a6-g7407ad622769509b-12">
    </meta>
    <title>Doorservice</title>
    <link rel="icon" href="{{ asset('frontend/img/fav.png') }}" type="image/png" sizes="32x32">
    <link href="{{ asset('style.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script>
        function googleTranslateElementInit() {
            var config = {
                pageLanguage: 'en',
                includedLanguages: 'bn,en,hi',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            };
            var langOptionsID = "google_translate_element";
            new google.translate.TranslateElement(config, langOptionsID);
        }
    </script> -->


    <style>
        body {
            padding: 0px;
            margin: 0px;
            top: 0px !important;
            background-color: #ffffff;
        }

        .asd {
            width: 100%;
            text-align: center;
            height: 10px;


        }

        .goog-te-banner-frame {
            display: none;
        }

        .goog-te-gadget {
            background-color: #000024;
            z-index: 2000;
            position: relative;
        }

        .goog-te-gadget .goog-te-combo {
            margin: 6px 0;
            background-color: #f2684d;
            ;
            border: 2px solid #f16044;
            border-radius: 5px;
            padding: 5px 8px;
            font-family: Merriweather Sans, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 400;
        }

        .translator-footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
        }
    </style>

</head>

<body>
    <div id="app"></div>


    <div id="google_translate_element" class="asd translator-footer"></div>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
            }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

</body>

</html>
