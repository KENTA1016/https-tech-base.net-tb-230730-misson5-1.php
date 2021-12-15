#include <stdio.h>
#define R 8
#define L 1
#define C 4

int main (void) {
   double I, v, t, dt, tmax;

   I=1.0;
   v = 0.0;
   dt=1.0/1024;
   tmax=100;

   for (t = 0.0; t <= tmax; t += dt) {
	   I += v * dt;
	   v += -(R*v / L + I / (C*L) )*dt;
	 printf("%lf %lf %lf\n",t,I,v);
    }

	return(0);
}