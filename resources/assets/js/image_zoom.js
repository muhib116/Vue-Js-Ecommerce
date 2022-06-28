class Image_zoom
{
    constructor(x={})
    {
        this.megnifierClass     = 'my_megnifier';
        this.images             = document.querySelectorAll(x.img);
        this.breakPoint         = (x.breakPoint == undefined) ? 768 : x.breakPoint;
        this.bgColor            = (x.bgColor       == undefined) ? '#fff5' : x.bgColor;
        this.borderColor        = (x.borderColor   == undefined) ? '#fff'  : x.borderColor;
        this.zIndex             = (x.zIndex        == undefined) ? 100 : x.zIndex;
        this.resultBgColor      = (x.resultBgColor == undefined) ? '#fff' : x.resultBgColor;
        this.megnifierSize      = (x.megnifierSize == undefined) ? {width:100, height:100} : {width:x.megnifierSize, height:x.megnifierSize};
        this.megnifierLoweLimit = (x.megnifierLoweLimit == undefined) ? 40  : x.megnifierLoweLimit;
        this.zoom               = (x.zoom == undefined) ? 5 : x.zoom;
        
        this.outputSize    = (x.outputSize == undefined) ? {
                                    width: (x.megnifierSize.width*3), 
                                    height: (x.megnifierSize.height*3)
                                } : {
                                    width: x.outputSize,
                                    height: x.outputSize
                                };
        

        /* run the image zoom according to condition start */
        if(innerWidth>this.breakPoint) this.run();
        addEventListener('resize', ()=>{
            if(innerWidth>this.breakPoint) this.run();
        });
        /* run the image zoom according to condition end */
    }


    run()
    {
        this.appendMegnifier();
        this.appendOutputElement();
    }

    /* work with megnifier start */
        createMegnifier()
        {
            let span = document.createElement('span');
            span.setAttribute('class', this.megnifierClass)
            span.style.cssText = `
                display: inline-block;
                width: ${this.megnifierSize.width}px;
                height: ${this.megnifierSize.height}px;
                position: absolute;
                top: 0;
                left: 0;
                background-color: ${this.bgColor};
                border: 1px solid ${this.borderColor};
                cursor: move;
                opacity: 0;
            `;

            return span;
        }


        appendMegnifier()
        {
            if(this.images)
            {
                this.images = Array.from(this.images);

                this.images.forEach(image=>
                {
                    let parentElement = image.parentElement,
                        megnifier     = this.createMegnifier();
                    
                    parentElement.style.cssText = 'position: relative';
                    
                    /* append megnifier to the image container */
                    parentElement.append(megnifier);

                    /* hide and unhide megnifier start */
                        parentElement.addEventListener('mouseover', ()=>
                        {
                            megnifier.style.opacity = 1;
                        });

                        parentElement.addEventListener('mouseout', ()=>
                        {
                            megnifier.style.opacity = 0;
                        });
                    /* hide and unhide megnifier end */
                    

                    this.moveMegnifierWithMouse(megnifier);
                    this.scaleUpDownMegnifier(megnifier);
                });
            }

        }


        moveMegnifierWithMouse(megnifier)
        {
            let myThis = this,
                parent = megnifier.parentElement;

            parent.addEventListener('mousemove', function(e)
            {
                let x = myThis.moveNow(e, myThis, parent, megnifier);
            });
        }


        moveNow(e, myThis, parent, megnifier)
        {
            let parentInf = parent.getBoundingClientRect(),
                left      = (e.clientX - parentInf.left) - (myThis.megnifierSize.width/2),
                top       = (e.clientY - parentInf.top)  - (myThis.megnifierSize.height/2);

            /* protect the megnifier to go outside of parent start */
                if(top<0) top   = 0;
                if(left<0) left = 0;

                if(top>(parentInf.height - myThis.megnifierSize.height))
                {
                    top = parentInf.height - myThis.megnifierSize.height;
                };

                if(left>(parentInf.width - myThis.megnifierSize.width))
                {
                    left = parentInf.width - myThis.megnifierSize.width;
                };
            /* protect the megnifier to go outside of parent end */
            
            megnifier.style.left = left + 'px';
            megnifier.style.top  = top + 'px';
        }


        scaleUpDownMegnifier(megnifier)
        {
            let myThis = this,
                parent = megnifier.parentElement;
            
            parent.addEventListener('wheel', (e)=>
            {
                e.preventDefault();
                
                if(e.deltaY>=0)
                {
                    if(myThis.megnifierSize.width > myThis.megnifierLoweLimit && myThis.megnifierSize.height > myThis.megnifierLoweLimit)
                    {
                        myThis.megnifierSize.width -= myThis.zoom;
                        myThis.megnifierSize.height -= myThis.zoom;
                    }
                }else
                {
                    if(myThis.megnifierSize.width < parent.offsetWidth && myThis.megnifierSize.height < parent.offsetHeight)
                    {
                        myThis.megnifierSize.width += myThis.zoom;
                        myThis.megnifierSize.height += myThis.zoom;
                    }
                }

                megnifier.style.width  =  myThis.megnifierSize.width + 'px';
                megnifier.style.height =  myThis.megnifierSize.height + 'px';

                myThis.moveNow(e, myThis, parent, megnifier);
            });


        }
    /* work with megnifier end */


    /* work with result output start */
        createOutputElement()
        {
            let div = document.createElement('div');
            div.style.cssText = `
                display: grid;
                place-content: center;
                width: ${this.outputSize.width}px;
                height: ${this.outputSize.height}px;
                position: absolute;
                top: 0;
                left: 100%;
                z-index: ${this.zIndex};
                background-color: ${this.resultBgColor};
                border: 1px solid ${this.borderColor};
            `;

            return div;
        }


        appendOutputElement()
        {
            if(this.images)
            {
                this.images = Array.from(this.images);

                this.images.forEach(image=>
                {
                    let parentElement = image.parentElement,
                        outputElement = this.createOutputElement();
                    
                    /* append createOutputElement to the image container */
                    
                    
                    /* hide and unhide outputElement start */
                        parentElement.addEventListener('mouseover', ()=>
                        {
                            parentElement.append(outputElement);

                            this.pushImageToOutput(outputElement);
                        });

                        parentElement.addEventListener('mouseout', ()=>
                        {
                            outputElement.remove();
                        });
                    /* hide and unhide outputElement end */
                    

                });
            }
        }


        pushImageToOutput(outputElement)
        {
            let parent    = outputElement.parentElement,
                megnifier = parent.querySelector('.'+this.megnifierClass),
                img       = parent.querySelector('img'),
                imgsrc    = img.dataset.src;

            /* create a preloader for output result start */
                this.createPreloader(outputElement, imgsrc);
            /* create a preloader for output result end */

            outputElement.style.backgroundImage  = `url(${imgsrc})`;
            outputElement.style.backgroundRepeat = `no-repeat`;

            this.showZoomPartOfImage(img, outputElement, megnifier);
        }


        createPreloader(outputElement, imgsrc)
        {
            let preloader = document.createElement('span');
            preloader.style.cssText = `
                display: inline-block;
                width: 30px;
                height: 30px;
                border: 3px dashed #ff5100;
                border-top: none;
                border-radius: 50%;
            `;

            outputElement.innerHTML = '';
            outputElement.append(preloader);

            /* create image and check the load time start */
                let img = new Image();
                img.src = imgsrc;
                img.addEventListener('load', ()=>{
                    preloader.remove();
                })
            /* create image and check the load time end */
        }


        showZoomPartOfImage(img, outputElement, megnifier)
        {
            animation();

            function animation()
            {
                let outputElement_inf = outputElement.getBoundingClientRect(),
                    megnifier_inf     = megnifier.getBoundingClientRect(),
                    xRation           = outputElement_inf.width / megnifier_inf.width,
                    yRation           = outputElement_inf.height / megnifier_inf.height,
                    bgWidth           = img.width * xRation,
                    bgHeight          = img.height * yRation,
                    bgLeft            = -(megnifier.offsetLeft * xRation),
                    bgTop             = -(megnifier.offsetTop * yRation);

                    
                outputElement.style.backgroundPosition = `${bgLeft}px ${bgTop}px`;
                outputElement.style.backgroundSize     = `${bgWidth}px ${bgHeight}px`;

                requestAnimationFrame(animation);    
            }

        }
    /* work with result output end */
}