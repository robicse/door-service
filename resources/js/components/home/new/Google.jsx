// import React, { useEffect, useState } from "react";
// import cookie from "react-cookies";

// import { googleTranslate } from "../../../utils/Translate";

// const Google=()=> {
//     const [languageCodes, setLanguageCodes] = useState([])
//     const [language, setLanguage] = useState(null)
//     const [question, setQuestion] = useState('')
   

//     useEffect(() => {
//         googleTranslate.getSupportedLanguages("en", function(err, languageCodes) {
//             getLanguageCodes(languageCodes); // use a callback function to setState
//           });
      
//           const getLanguageCodes = languageCodes => {
//             setLanguageCodes(languageCodes)
//           };
//     }, [])

//     changeHandler = language => {
//         let cookieLanguage = cookie.load("language");
//         let transQuestion = "";
    
//         const translating = transQuestion => {
//           if (question !== transQuestion) {
//             setQuestion(transQuestion);
//             cookie.save("question", transQuestion, { path: "/" });
//           }
//         };
    
//         // translate the question when selecting a different language
//         if (language !== cookieLanguage) {
//           googleTranslate.translate(question, language, function(err, translation) {
//             transQuestion = translation.translatedText;
//             translating(transQuestion);
//           });
//         }
    
//        setLanguage(language)
//         cookie.save("language", language, { path: "/" });
//       };



//     return (
//       <div>
//         <p>{question}</p>

//         {/* iterate through language options to create a select box */}
//         <select
//           className="select-language"
//           value={language}
//           onChange={e => changeHandler(e.target.value)}
//         >
//           {languageCodes.map(lang => (
//             <option key={lang.language} value={lang.language}>
//               {lang.name}
//             </option>
//           ))}
//         </select>
//       </div>
//     )
// }

// export default Google