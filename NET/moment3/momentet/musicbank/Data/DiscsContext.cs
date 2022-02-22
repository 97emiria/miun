using Microsoft.EntityFrameworkCore;
using musicbank.Models;

namespace musicbank.Data
{
    public class DiscsContext : DbContext
    {

        public DiscsContext(DbContextOptions<DiscsContext> options) : base(options)
        {

        }

        public DbSet<Discs> Discs { get; set; }


    }
}
