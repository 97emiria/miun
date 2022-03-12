#nullable disable
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using ReceProject.Data;
using ReceProject.Models;

namespace ReceProject.Controllers
{
    public class NewsController : Controller
    {
        private readonly ModelsContext _context;
        private readonly IWebHostEnvironment _hostEnvironment;

        public NewsController(ModelsContext context, IWebHostEnvironment hostEnvironment)
        {
            _context = context;
            _hostEnvironment = hostEnvironment;
        }

        // GET: News
        public async Task<IActionResult> Index(string searchString)
        {
            //Search
            var news = from m in _context.News select m;
            if (!String.IsNullOrEmpty(searchString))
            {
                news = news.Where(s => s.Hashtags!.Contains(searchString));

                //Return search result
            }
                return View(await news.ToListAsync());
                  
            //return View(await _context.News.ToListAsync());
        }

        // GET: News/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var news = await _context.News
                .FirstOrDefaultAsync(m => m.id == id);
            if (news == null)
            {
                return NotFound();
            }

            return View(news);
        }

        // GET: News/Create
        public IActionResult Create()
        {
            return View();
        }

        // POST: News/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("id,Header,Text,Hashtags,Author,ImageFile,Publish,LastUpdated")] News news)
        {
            if (ModelState.IsValid)
            {

                //Upload image 
                if(news.ImageFile != null) {
                        
                    //Strings
                    string wwwRootPath = _hostEnvironment.WebRootPath;                  //String to wwwroot folder / file path

                    //Add file to model / Save filename to database
                    //string fileName = Path.GetFileName(news.ImageFile.FileName);                  //Filename
                    string fileName = Path.GetFileNameWithoutExtension(news.ImageFile.FileName);    //File name without 
                    string extension = Path.GetExtension(news.ImageFile.FileName);                  //Filhändelse / datatyp
                    fileName = fileName + DateTime.Now.ToString("yyyyMMddssff") + extension;

                    news.ImageName = fileName;

                    //Output path
                    string path = Path.Combine(wwwRootPath + "/uploadsNews/" + fileName);

                    //Move to folder 
                    using(var fileStream = new FileStream(path, FileMode.Create)) 
                    {
                        await news.ImageFile.CopyToAsync(fileStream);
                    }

                }


                _context.Add(news);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(news);
        }

        // GET: News/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var news = await _context.News.FindAsync(id);
            if (news == null)
            {
                return NotFound();
            }
            return View(news);
        }

        // POST: News/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("id,Header,Text,Hashtags,Author,ImageName,Publish,LastUpdated")] News news)
        {
            if (id != news.id)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(news);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!NewsExists(news.id))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }
            return View(news);
        }

        // GET: News/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var news = await _context.News
                .FirstOrDefaultAsync(m => m.id == id);
            if (news == null)
            {
                return NotFound();
            }

            return View(news);
        }

        // POST: News/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var news = await _context.News.FindAsync(id);
            _context.News.Remove(news);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool NewsExists(int id)
        {
            return _context.News.Any(e => e.id == id);
        }
    }
}
