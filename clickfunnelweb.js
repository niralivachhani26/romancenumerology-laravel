$(document).ready(function () {
    console.log("Document is ready!");
    $('a[data-href-original="#submit-form"]').click(function (e) {
      e.preventDefault();
  
      // Collect form values
      const preference = $("select[data-custom-type='preference']").val();
      const relationship = $("select[data-custom-type='relationship']").val();
      const zodiac = $("select[data-custom-type='zodiac']").val();
      const f_name = $("input[name='first_name']").val();
      const l_name = $("input[name='last_name']").val();
      const birthdate = $("input[data-custom-type='birthdate']").val();
      const email = $("input[type='email']").val();
  
      console.log("Collected Data:", { f_name, l_name, email, preference, relationship, zodiac });
  
      // First ConvertKit form submission
      const data = {
        api_key: "bXx6uwWtbbwG5R148KdSwQ", // Replace with real API key
        email: email,
        first_name: f_name,
        last_name: l_name,
        fields: {
          who_are_you_interested_in: preference,
          relationship_status: relationship,
          zodiac_sign: zodiac,
          date_of_birth: birthdate,
        },
        form_id: "7847157",
      };
  
      console.log("🚀 Sending Data to First ConvertKit Form:", data);
  
      fetch("https://api.convertkit.com/v3/forms/7847157/subscribe", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      })
        .then(response => response.json())
        .then(responseData => {
          console.log("✅ First ConvertKit Response:", responseData);
  
          if (responseData.subscription) {
            // Second ConvertKit form submission
            const data1 = {
              api_key: "kSBwkFkNZkJZuyMaAZaWOw", // Replace with real API key
              email: email,
              first_name: f_name,
              last_name: l_name,
              fields: {
                who_are_you_interested_in: preference,
                relationship_status: relationship,
                zodiac_sign: zodiac,
                date_of_birth: birthdate,
              },
              form_id: "7847174",
            };
  
            console.log("🚀 Sending Data to Second ConvertKit Form:", data1);
  
            return fetch("https://api.convertkit.com/v3/forms/7847174/subscribe", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify(data1),
            });
          } else {
            throw new Error("First subscription failed");
          }
        })
        .then(response => response.json())
        .then(responseData => {
          console.log("✅ Second ConvertKit Response:", responseData);
  
          if (responseData.subscription) {
            console.log("🎉 Both subscriptions successful!");
            window.location.href = "https://www.soulmatesketch.com/new-soulmate-sketch-cb1656443503379?cf_uvid=7a627d397bbeb7a041269ce01708435c";
          } else {
            console.error("⚠️ Second ConvertKit Response Error:", responseData);
          }
        })
        .catch(error => {
          console.error("❌ Error during ConvertKit submission:", error);
        });
    });
  });
  