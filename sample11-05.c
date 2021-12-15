#include <stdio.h>
double dt = 1.0 / 1024;

void RK(double t, double x, double v, double *xk, double *vk) {
	*xk = v * dt;
	*vk = (-x)*dt;
}

int main (void) {
   double x, v, t, dt, tmax;
   double xk[4], vk[4];

   x=1.0;
   v=0.0;
   dt=0.01;
   tmax=10;

   for(t=0.0;t<=tmax;t+=dt) {
	   RK(t, x, v, &xk[0], &vk[0]);
	   RK(t + 0.5*dt, x + 0.5*xk[0], v + 0.5*vk[0], &xk[1], &vk[1]);
	   RK(t + 0.5*dt, x + 0.5*xk[1], v + 0.5*vk[1], &xk[2], &vk[2]);
	   RK(t + dt, x + xk[2], v + vk[2], &xk[3], &vk[3]);

	  printf("%lf %lf %lf\n",t,x,v);
	}

	return(0);
}