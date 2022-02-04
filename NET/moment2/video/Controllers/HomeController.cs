using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using video.Models;

namespace video.Controllers
{
    public class HomeController : Controller
    {

        //Startsidan
        public IActionResult Index()
        {
            var JsonStr = System.IO.File.ReadAllText("courses.json");
            var JsonObj = JsonConvert.DeserializeObject<List<CourseModel>>(JsonStr);
                        
            return View(JsonObj);
        }

        //Om mig
        //[HttpGet("/om")]
        public IActionResult About()
        {
            return View();
        }

        //Kurser
        public IActionResult Courses()
        {
            return View();
        }

        [HttpPost]
        public IActionResult Courses(CourseModel model)
        {
            if (ModelState.IsValid)
            {
                // Läs in befintliga
                var JsonStr = System.IO.File.ReadAllText("courses.json");
                var JsonObj = JsonConvert.DeserializeObject<List<CourseModel>>(JsonStr);

                // Lägg till
                if (JsonObj != null)
                {
                    JsonObj.Add(model);
                }
                // Konvertera till JSON-sträng och spara
                System.IO.File.WriteAllText("courses.json", JsonConvert.SerializeObject(JsonObj, Formatting.Indented));
            
                ModelState.Clear();
            }
            

            return View();
        }
    }
}