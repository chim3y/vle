var tour = new Tour({
  steps: [
  {
    element: ".one",
    title: "Welcome",
    content: "Welcome to our app, take this tour to be familirized with it."
  },
  {
    element: ".two",
    title: "This Image",
    content: "In this application we generate random placeholder images for any case."
  }  
]
});

tour.init();
tour.start();