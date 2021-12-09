{
 "cells": [
  {
   "cell_type": "code",
   "execution_count": 2,
   "id": "351a6dbe",
   "metadata": {},
   "outputs": [],
   "source": [
    "import pandas as pd\n",
    "import uuid"
   ]
  },
  {
   "cell_type": "code",
   "execution_count": 3,
   "id": "91103e73",
   "metadata": {
    "scrolled": true
   },
   "outputs": [],
   "source": [
    "c = pd.read_csv(\"Class.csv\")"
   ]
  },
  {
   "cell_type": "code",
   "execution_count": 4,
   "id": "b23956d0",
   "metadata": {},
   "outputs": [
    {
     "name": "stdout",
     "output_type": "stream",
     "text": [
      "('9940f768-5607-11ec-b7c6-b46bfc47735d', dtype('O'))\n",
      "('fC8CoZyN8g', dtype('O'))\n",
      "('CS171', dtype('O'))\n",
      "('Introduction to Computer Science II', dtype('O'))\n",
      "('Fall', dtype('O'))\n",
      "('2017', dtype('int64'))\n"
     ]
    }
   ],
   "source": [
    "\n",
    "for dtype in c.dtypes.iteritems():\n",
    "    print(dtype)"
   ]
  },
  {
   "cell_type": "code",
   "execution_count": null,
   "id": "6cd98c18",
   "metadata": {},
   "outputs": [],
   "source": []
  }
 ],
 "metadata": {
  "kernelspec": {
   "display_name": "Python 3",
   "language": "python",
   "name": "python3"
  },
  "language_info": {
   "codemirror_mode": {
    "name": "ipython",
    "version": 3
   },
   "file_extension": ".py",
   "mimetype": "text/x-python",
   "name": "python",
   "nbconvert_exporter": "python",
   "pygments_lexer": "ipython3",
   "version": "3.8.8"
  }
 },
 "nbformat": 4,
 "nbformat_minor": 5
}
