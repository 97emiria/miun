//Activates MVC
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using momentet.Models;

namespace momentet.Controllers
{

    public class HomeController : Controller
    {

      public IActionResult Index()
        {
            ViewBag.date = DateTime.Now.ToString("yyyy-MM-dd");
            return View();
        }


        [HttpGet("/om")]
        public IActionResult About()
        {
            var JsonStr = System.IO.File.ReadAllText("data/courses.json");
            var JsonObj = JsonConvert.DeserializeObject<List<CourseModel>>(JsonStr);
                        
            return View(JsonObj);
        }


          public IActionResult GuestBook()
        {
            return View();
        }

        [HttpPost]
          public IActionResult GuestBook(GuestBookModel model)
        {
             if (ModelState.IsValid)
            {
                // Läs in befintliga
                var JsonStr = System.IO.File.ReadAllText("data/guestbook.json");
                var JsonObj = JsonConvert.DeserializeObject<List<CourseModel>>(JsonStr);

                // Lägg till
                if (JsonObj != null)
                {
                    JsonObj.Add(model);
                }
                // Konvertera till JSON-sträng och spara
                System.IO.File.WriteAllText("data/guestbook.json", JsonConvert.SerializeObject(JsonObj, Formatting.Indented));
            
                ModelState.Clear();
            }
            return View();
        }

    }
}