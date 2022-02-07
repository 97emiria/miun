//Activates MVC
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using momentet.Models;

namespace momentet.Controllers
{

    public class CourseController : Controller
    {

      public IActionResult Index()
        {
            var JsonStr = System.IO.File.ReadAllText("data/courses.json");
            var JsonObj = JsonConvert.DeserializeObject<List<CourseModel>>(JsonStr);
                        
            return View(JsonObj);
        }


        //[HttpGet("/kurser/läggtill")]
        public IActionResult Add()
        {
            return View();
        }

        [HttpPost]
        public IActionResult Add(CourseModel model)
        {
             if (ModelState.IsValid)
            {
                // Läs in befintliga
                var JsonStr = System.IO.File.ReadAllText("data/courses.json");
                var JsonObj = JsonConvert.DeserializeObject<List<CourseModel>>(JsonStr);

                // Lägg till
                if (JsonObj != null)
                {
                    JsonObj.Add(model);
                }
                // Konvertera till JSON-sträng och spara
                System.IO.File.WriteAllText("data/courses.json", JsonConvert.SerializeObject(JsonObj, Formatting.Indented));
            
                ModelState.Clear();
            }
            
            return View();
        }
    }
}