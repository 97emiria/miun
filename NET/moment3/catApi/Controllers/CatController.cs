#nullable disable
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using CatApi.Data;
using CatApi.Models;

namespace catApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class CatController : ControllerBase
    {
        private readonly CatContext _context;

        public CatController(CatContext context)
        {
            _context = context;
        }

        // GET: api/Cat
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Cat>>> GetCat()
        {
            return await _context.Cat.ToListAsync();
        }

        // GET: api/Cat/5
        [HttpGet("{id}")]
        public async Task<ActionResult<Cat>> GetCat(int id)
        {
            var cat = await _context.Cat.FindAsync(id);

            if (cat == null)
            {
                return NotFound();
            }

            return cat;
        }

        // PUT: api/Cat/5
        // To protect from overposting attacks, see https://go.microsoft.com/fwlink/?linkid=2123754
        [HttpPut("{id}")]
        public async Task<IActionResult> PutCat(int id, Cat cat)
        {
            if (id != cat.Id)
            {
                return BadRequest();
            }

            _context.Entry(cat).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!CatExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Cat
        // To protect from overposting attacks, see https://go.microsoft.com/fwlink/?linkid=2123754
        [HttpPost]
        public async Task<ActionResult<Cat>> PostCat(Cat cat)
        {
            _context.Cat.Add(cat);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetCat", new { id = cat.Id }, cat);
        }

        // DELETE: api/Cat/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteCat(int id)
        {
            var cat = await _context.Cat.FindAsync(id);
            if (cat == null)
            {
                return NotFound();
            }

            _context.Cat.Remove(cat);
            await _context.SaveChangesAsync();

            return NoContent();
        }

        private bool CatExists(int id)
        {
            return _context.Cat.Any(e => e.Id == id);
        }
    }
}
