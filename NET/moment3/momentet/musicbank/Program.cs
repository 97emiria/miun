using Microsoft.EntityFrameworkCore;
using musicbank.Data;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddControllersWithViews();

builder.Services.AddDbContext<DiscsContext>(options =>
options.UseSqlite(builder.Configuration.GetConnectionString("DiscsDbString")));

builder.Services.AddDbContext<ArtistsContext>(options =>
options.UseSqlite(builder.Configuration.GetConnectionString("ArtistDbString")));


var app = builder.Build();

if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Home/Error");
    app.UseHsts();
}

app.UseHttpsRedirection();
app.UseStaticFiles();

app.UseRouting();

app.UseAuthorization();

app.MapControllerRoute(
    name: "default",
    pattern: "{controller=Home}/{action=Index}/{id?}");

app.Run();
